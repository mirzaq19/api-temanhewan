<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingOrderReview;

use App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview\CreateGroomingOrderReviewResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use Exception;

class GetGroomingOrderReviewService
{
    public function __construct(
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws Exception
     */
    public function execute(GetGroomingOrderReviewRequest $request): CreateGroomingOrderReviewResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if (!$groomingOrder)
            throw new TemanhewanException("Grooming order not found", 1121);

        if(!$groomingOrder->isReviewed())
            throw new TemanhewanException("Grooming order not reviewed", 1122);

        $groomingOrderReview = $this->groomingOrderRepository->getReview($groomingOrderId);

        return new CreateGroomingOrderReviewResponse($groomingOrderReview);
    }
}
