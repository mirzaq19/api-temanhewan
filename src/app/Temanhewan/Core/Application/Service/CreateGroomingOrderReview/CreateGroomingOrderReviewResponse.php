<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview;

use App\Temanhewan\Core\Domain\Model\GroomingOrderReview;
use JsonSerializable;

class CreateGroomingOrderReviewResponse implements JsonSerializable
{
    public function __construct(
        private GroomingOrderReview $groomingOrderReview
    ){}


    public function jsonSerialize()
    {
        return [
            'id' => $this->groomingOrderReview->getId(),
            'rating' => $this->groomingOrderReview->getRating(),
            'review' => $this->groomingOrderReview->getReview(),
            'is_public' => $this->groomingOrderReview->isPublic(),
            'customer_id' => $this->groomingOrderReview->getCustomerId()->id(),
            'grooming_id' => $this->groomingOrderReview->getGroomingId()->id(),
            'grooming_service_id' => $this->groomingOrderReview->getGroomingServiceId()->id(),
            'grooming_order_id' => $this->groomingOrderReview->getGroomingOrderId()->id(),
            'created_at' => $this->groomingOrderReview->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->groomingOrderReview->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
