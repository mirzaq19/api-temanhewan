<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview;

class CreateGroomingOrderReviewRequest
{
    public function __construct(
        private string $id,
        private int $rating,
        private string $review,
        private bool $is_public,
    ){}

    /**
     * @return string
     */
    public function getId(): string
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
}
