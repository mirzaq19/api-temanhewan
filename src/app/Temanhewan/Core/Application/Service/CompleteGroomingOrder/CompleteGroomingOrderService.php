<?php

namespace App\Temanhewan\Core\Application\Service\CompleteGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CompleteGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CompleteGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found', 1101);

        if($groomingOrder->getStatus()->getValue() != GroomingOrderStatus::DELIVERED)
            throw new TemanhewanException('Only deliver order can be complete', 1102);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->byId($customerId);

        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('Only customer can complete grooming order', 1103);

        if($customer->getId()->id() != $groomingOrder->getCustomerId()->id())
            throw new TemanhewanException('You are not authorized to complete this order', 1104);

        $this->groomingOrderRepository->complete($groomingOrderId);

        $updatedGroomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        return new CreateGroomingOrderResponse($updatedGroomingOrder);
    }
}
