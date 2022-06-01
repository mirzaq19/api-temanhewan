<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class Consultation
{
    private ConsultationId $id;
    private string $complaint;
    private string $address;
    private DateTime $date;
    private ?int $fee;
    private ConsultationStatus $status;
    private UserId $customerId;
    private UserId $doctorId;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    /**
     * @param ConsultationId $id
     * @param string $complaint
     * @param string $address
     * @param DateTime $date
     * @param int|null $fee
     * @param ConsultationStatus $status
     * @param UserId $customerId
     * @param UserId $doctorId
     */
    public function __construct(
        ConsultationId $id,
        string $complaint,
        string $address,
        DateTime $date,
        ?int $fee,
        ConsultationStatus $status,
        UserId $customerId,
        UserId $doctorId)
    {
        $this->id = $id;
        $this->complaint = $complaint;
        $this->address = $address;
        $this->date = $date;
        $this->fee = $fee;
        $this->status = $status;
        $this->customerId = $customerId;
        $this->doctorId = $doctorId;
    }

    /**
     * @return ConsultationId
     */
    public function getId(): ConsultationId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getComplaint(): string
    {
        return $this->complaint;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return int|null
     */
    public function getFee(): ?int
    {
        return $this->fee;
    }

    /**
     * @return ConsultationStatus
     */
    public function getStatus(): ConsultationStatus
    {
        return $this->status;
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
    public function getDoctorId(): UserId
    {
        return $this->doctorId;
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
     * @param string $complaint
     */
    public function setComplaint(string $complaint): void
    {
        $this->complaint = $complaint;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @param int|null $fee
     */
    public function setFee(?int $fee): void
    {
        $this->fee = $fee;
    }

    /**
     * @param ConsultationStatus $status
     */
    public function setStatus(ConsultationStatus $status): void
    {
        $this->status = $status;
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
