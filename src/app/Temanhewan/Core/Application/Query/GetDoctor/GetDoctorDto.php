<?php

namespace App\Temanhewan\Core\Application\Query\GetDoctor;

use JsonSerializable;

class GetDoctorDto implements JsonSerializable
{
    public function __construct(
        public string $id,
        public string $name,
        public string $avatar,
        public string $email,
        public string $gender,
        public string $address,
        public string $phone,
        public float $rating,
        public int $count_review
    ){}

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
            'name' => $this->name,
            'avatar' => $this->getAvatarImageUrl($this->avatar),
            'email' => $this->email,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
            'rating' => $this->rating,
            'count_review' => $this->count_review
        ];
    }
}
