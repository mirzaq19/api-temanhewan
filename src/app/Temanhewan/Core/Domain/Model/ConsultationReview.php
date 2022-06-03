<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class ConsultationReview
{
    private int $id;
    private int $rating;
    private string $review;
    private bool $is_public;
    private UserId $customerId;
    private UserId $doctorId;
    private ConsultationId $consultationId;
    private DateTime $created_at;
    private DateTime $updated_at;

    /**
     * @param int $rating
     * @param string $review
     * @param bool $is_public
     * @param UserId $customerId
     * @param UserId $doctorId
     * @param ConsultationId $consultationId
     */
    public function __construct(
        int $rating,
        string $review,
        bool $is_public,
        UserId $customerId,
        UserId $doctorId,
        ConsultationId $consultationId)
    {
        $this->rating = $rating;
        $this->review = $review;
        $this->is_public = $is_public;
        $this->customerId = $customerId;
        $this->doctorId = $doctorId;
        $this->consultationId = $consultationId;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getReview(): string
    {
        return $this->review;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->is_public;
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
     * @return ConsultationId
     */
    public function getConsultationId(): ConsultationId
    {
        return $this->consultationId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @param string $review
     */
    public function setReview(string $review): void
    {
        $this->review = $review;
    }

    /**
     * @param bool $is_public
     */
    public function setIsPublic(bool $is_public): void
    {
        $this->is_public = $is_public;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
