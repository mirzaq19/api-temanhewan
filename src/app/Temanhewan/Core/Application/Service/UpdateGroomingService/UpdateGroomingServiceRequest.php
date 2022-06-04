<?php

namespace App\Temanhewan\Core\Application\Service\UpdateGroomingService;

class UpdateGroomingServiceRequest
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private int $price,
    ){}

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

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


}
