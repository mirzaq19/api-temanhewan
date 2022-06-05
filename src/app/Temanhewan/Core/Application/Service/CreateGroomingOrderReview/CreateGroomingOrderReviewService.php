<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingOrderId;
use App\Temanhewan\Core\Domain\Model\GroomingOrderReview;
use App\Temanhewan\Core\Domain\Model\GroomingOrderStatus;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;

class CreateGroomingOrderReviewService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws Exception
     */
    public function execute(CreateGroomingOrderReviewRequest $request): CreateGroomingOrderReviewResponse
    {
        $groomingOrderId = new GroomingOrderId($request->getId());
        $groomingOrder = $this->groomingOrderRepository->byId($groomingOrderId);

        if(!$groomingOrder)
            throw new TemanhewanException("Grooming order doesn't exist",1116);

        if($groomingOrder->isReviewed())
            throw new TemanhewanException("Grooming order has been reviewed",1117);

        if($groomingOrder->getStatus()->getValue() != GroomingOrderStatus::COMPLETED)
            throw new TemanhewanException("Grooming order is not completed",1118);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->byId($customerId);

        if($groomingOrder->getCustomerId()->id() != $customer->getId()->id())
            throw new TemanhewanException("You are not the customer of this grooming order",1119);

        $groomingOrderReview = new GroomingOrderReview(
            $request->getRating(),
            $request->getReview(),
            $request->isPublic(),
            $groomingOrder->getCustomerId(),
            $groomingOrder->getGroomingId(),
            $groomingOrder->getGroomingServiceId(),
            $groomingOrder->getId()
        );

        $this->groomingOrderRepository->saveReview($groomingOrderReview);

        $newGroomingOrderReview = $this->groomingOrderRepository->getReview($groomingOrderId);

        if(!$newGroomingOrderReview)
            throw new TemanhewanException("Failed to create review",1120);

        return new CreateGroomingOrderReviewResponse($newGroomingOrderReview);
    }
}
