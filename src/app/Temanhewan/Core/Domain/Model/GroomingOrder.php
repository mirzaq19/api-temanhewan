<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class GroomingOrder
{
    private GroomingOrderId $id;
    private string $address;
    private bool $isReviewed = false;
    private GroomingOrderStatus $status;
    private GroomingServiceId $groomingServiceId;
    private PetId $petId;
    private UserId $customerId;
    private UserId $groomingId;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    /**
     * @param GroomingOrderId $id
     * @param string $address
     * @param GroomingOrderStatus $status
     * @param GroomingServiceId $groomingServiceId
     * @param PetId $petId
     * @param UserId $customerId
     * @param UserId $groomingId
     */
    public function __construct(
        GroomingOrderId $id,
        string $address,
        GroomingOrderStatus $status,
        GroomingServiceId $groomingServiceId,
        PetId $petId,
        UserId $customerId,
        UserId $groomingId)
    {
        $this->id = $id;
        $this->address = $address;
        $this->status = $status;
        $this->groomingServiceId = $groomingServiceId;
        $this->petId = $petId;
        $this->customerId = $customerId;
        $this->groomingId = $groomingId;
    }

    /**
     * @return GroomingOrderId
     */
    public function getId(): GroomingOrderId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function isReviewed(): bool
    {
        return $this->isReviewed;
    }

    /**
     * @return GroomingOrderStatus
     */
    public function getStatus(): GroomingOrderStatus
    {
        return $this->status;
    }

    /**
     * @return GroomingServiceId
     */
    public function getGroomingServiceId(): GroomingServiceId
    {
        return $this->groomingServiceId;
    }

    /**
     * @return PetId
     */
    public function getPetId(): PetId
    {
        return $this->petId;
    }

    /**
     * @return UserId
     */
    public function getCustomerId(): UserId
    {
        return $this->customerId;
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
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param GroomingOrderStatus $status
     */
    public function setStatus(GroomingOrderStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @param bool $isReviewed
     */
    public function setIsReviewed(bool $isReviewed): void
    {
        $this->isReviewed = $isReviewed;
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
