<?php

namespace App\Temanhewan\Core\Application\Service\ConfirmGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class ConfirmGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(ConfirmGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found', 1093);

        if($groomingOrder->getStatus()->getValue() != GroomingOrderStatus::PAID)
            throw new TemanhewanException('Only paid order can be confirmed', 1094);

        $groomingId = new UserId(auth()->user()->getAuthIdentifier());
        $grooming = $this->userRepository->byId($groomingId);

        if($grooming->getRole()->getValue() != Role::GROOMING)
            throw new TemanhewanException('Only grooming can confirm grooming order', 1095);

        if($grooming->getId()->id() != $groomingOrder->getGroomingId()->id())
            throw new TemanhewanException('You are not authorized to confirm this order', 1096);

        $this->groomingOrderRepository->confirm($groomingOrderId);

        $updatedGroomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        return new CreateGroomingOrderResponse($updatedGroomingOrder);
    }
}
