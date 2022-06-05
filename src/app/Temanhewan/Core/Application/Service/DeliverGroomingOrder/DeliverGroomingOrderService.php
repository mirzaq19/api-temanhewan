<?php

namespace App\Temanhewan\Core\Application\Service\DeliverGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class DeliverGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeliverGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found', 1097);

        if($groomingOrder->getStatus()->getValue() != GroomingOrderStatus::CONFIRMED)
            throw new TemanhewanException('Only confirm order can be deliver', 1098);

        $groomingId = new UserId(auth()->user()->getAuthIdentifier());
        $grooming = $this->userRepository->byId($groomingId);

        if($grooming->getRole()->getValue() != Role::GROOMING)
            throw new TemanhewanException('Only grooming can deliver grooming order', 1099);

        if($grooming->getId()->id() != $groomingOrder->getGroomingId()->id())
            throw new TemanhewanException('You are not authorized to deliver this order', 1100);

        $this->groomingOrderRepository->deliver($groomingOrderId);

        $updatedGroomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        return new CreateGroomingOrderResponse($updatedGroomingOrder);
    }
}
