<?php

namespace App\Temanhewan\Core\Application\Query\GetDoctorReviews;

use JsonSerializable;

class GetDoctorReviewsDto implements JsonSerializable
{
    public function __construct(
        public int $id,
        public int $rating,
        public string $review,
        public bool $is_public,
        public string $customer_id,
        public string $customer_name,
        public string $customer_avatar,
        public string $created_at,
        public string $updated_at,
    ){ }

    public function getAvatarImageUrl(string $filename): string
    {
        if ($filename == 'user_default.png'){
            return asset('image/'. $filename);
        }
        return asset('storage/user/profile_images/' . $filename);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'rating' => $this->rating,
            'review' => $this->review,
            'is_public' => $this->is_public,
            'customer' => [
                'id' => $this->customer_id,
                'name' => $this->customer_name,
                'avatar' => $this->getAvatarImageUrl($this->customer_avatar),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
