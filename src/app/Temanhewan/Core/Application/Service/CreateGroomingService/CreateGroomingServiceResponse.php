<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingService;

use App\Temanhewan\Core\Domain\Model\GroomingService;
use JsonSerializable;

class CreateGroomingServiceResponse implements JsonSerializable
{
    public function __construct(
        private GroomingService $groomingService
    ){}

    public function jsonSerialize()
    {
        return [
            'id' => $this->groomingService->getId()->id(),
            'name' => $this->groomingService->getName(),
            'description' => $this->groomingService->getDescription(),
            'price' => $this->groomingService->getPrice(),
            'grooming_id' => $this->groomingService->getGroomingId()->id(),
            'created_at' => $this->groomingService->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->groomingService->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }
}
