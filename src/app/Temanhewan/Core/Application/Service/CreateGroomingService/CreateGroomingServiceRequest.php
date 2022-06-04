<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingService;

class CreateGroomingServiceRequest
{
    public function __construct(
        private string $name,
        private string $description,
        private int $price,
        private string $grooming_id
    ){}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getGroomingId(): string
    {
        return $this->grooming_id;
    }
}
