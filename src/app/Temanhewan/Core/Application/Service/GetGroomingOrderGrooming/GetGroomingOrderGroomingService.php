<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingOrderGrooming;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetGroomingOrderGroomingService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetGroomingOrderGroomingRequest $request): array
    {
        $groomingId = new UserId($request->getGroomingId());
        $grooming = $this->userRepository->byId($groomingId);

        if(!$grooming)
            throw new TemanhewanException("Customer not found",1114);

        $groomingOrders = $this->groomingOrderRepository->byGroomingId($groomingId, $request->getOffset(), $request->getLimit());

        $response = [];
        foreach($groomingOrders as $groomingOrder) {
            $response[] = new CreateGroomingOrderResponse($groomingOrder);
        }

        return $response;
    }
}
