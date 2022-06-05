<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingOrder;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;

class GetGroomingOrderService
{
    public function __construct(
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException('Grooming order not found',1113);

        return new CreateGroomingOrderResponse($groomingOrder);
    }
}
