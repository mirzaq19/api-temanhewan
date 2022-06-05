<?php

namespace App\Temanhewan\Core\Application\Service\PaidGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class PaidGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(PaidGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found', 1089);

        if($groomingOrder->getStatus()->getValue() != GroomingOrderStatus::PENDING)
            throw new TemanhewanException('Only pending order can be paid', 1090);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->byId($customerId);

        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('Only customer can pay grooming order', 1091);

        if($customer->getId()->id() != $groomingOrder->getCustomerId()->id())
            throw new TemanhewanException('You are not authorized to paid this order', 1092);

        $this->groomingOrderRepository->paid($groomingOrderId);

        $updatedGroomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        return new CreateGroomingOrderResponse($updatedGroomingOrder);
    }
}
