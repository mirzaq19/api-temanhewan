<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrder;

class CreateGroomingOrderRequest
{
    public function __construct(
        private string $address,
        private string $grooming_service_id,
        private string $pet_id,
    ){}

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getGroomingServiceId(): string
    {
        return $this->grooming_service_id;
    }

    /**
     * @return string
     */
    public function getPetId(): string
    {
        return $this->pet_id;
    }
}
