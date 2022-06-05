<?php

namespace App\Temanhewan\Core\Application\Service\CancelGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CancelGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CancelGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found', 1105);

        if(!in_array($groomingOrder->getStatus()->getValue(),[GroomingOrderStatus::PENDING,GroomingOrderStatus::PAID]))
            throw new TemanhewanException('Only pending / paid order can be cancel', 1106);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->byId($customerId);

        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('Only customer can cancel grooming order', 1107);

        if($customer->getId()->id() != $groomingOrder->getCustomerId()->id())
            throw new TemanhewanException('You are not authorized to cancel this order', 1108);

        $this->groomingOrderRepository->cancel($groomingOrderId);

        $updatedGroomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        return new CreateGroomingOrderResponse($updatedGroomingOrder);
    }
}
