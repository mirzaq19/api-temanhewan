<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class GroomingService
{
    private GroomingServiceId $id;
    private string $name;
    private string $description;
    private string $price;
    private UserId $groomingId;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    /**
     * @param GroomingServiceId $id
     * @param string $name
     * @param string $description
     * @param string $price
     * @param UserId $groomingId
     */
    public function __construct(GroomingServiceId $id, string $name, string $description, string $price, UserId $groomingId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->groomingId = $groomingId;
    }

    /**
     * @return GroomingServiceId
     */
    public function getId(): GroomingServiceId
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
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return UserId
     */
    public function getGroomingId(): UserId
    {
        return $this->groomingId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}
