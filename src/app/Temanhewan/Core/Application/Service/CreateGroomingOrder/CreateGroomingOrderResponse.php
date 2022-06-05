<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrder;

use App\Temanhewan\Core\Domain\Model\GroomingOrder;
use JsonSerializable;

class CreateGroomingOrderResponse implements JsonSerializable
{
    public function __construct(
        private GroomingOrder $groomingOrder
    ){}

    public function jsonSerialize()
    {
        return [
            'id' => $this->groomingOrder->getId()->id(),
            'address' => $this->groomingOrder->getAddress(),
            'is_reviewed' => $this->groomingOrder->isReviewed(),
            'status' => $this->groomingOrder->getStatus()->getValue(),
            'grooming_service_id' => $this->groomingOrder->getGroomingServiceId()->id(),
            'pet_id' => $this->groomingOrder->getPetId()->id(),
            'customer_id' => $this->groomingOrder->getCustomerId()->id(),
            'grooming_id' => $this->groomingOrder->getGroomingId()->id(),
            'created_at' => $this->groomingOrder->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->groomingOrder->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
