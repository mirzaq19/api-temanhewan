<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingOrderCustomer;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetGroomingOrderCustomerService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetGroomingOrderCustomerRequest $request): array
    {
        $customerId = new UserId($request->getCustomerId());
        $customer = $this->userRepository->byId($customerId);

        if(!$customer)
            throw new TemanhewanException("Customer not found",1114);

        $groomingOrders = $this->groomingOrderRepository->byCustomerId($customerId,$request->getOffset(),$request->getLimit());

        $response = [];
        foreach($groomingOrders as $groomingOrder) {
            $response[] = new CreateGroomingOrderResponse($groomingOrder);
        }

        return $response;
    }
}
