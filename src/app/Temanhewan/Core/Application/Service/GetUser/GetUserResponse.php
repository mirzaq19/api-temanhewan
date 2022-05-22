<?php

namespace App\Temanhewan\Core\Application\Service\GetUser;

use App\Temanhewan\Core\Domain\Model\User;
use JsonSerializable;

class GetUserResponse implements JsonSerializable
{
    public function __construct(
        private User $user
    ){}

    public function getProfileImageUrl(string $name): string
    {
        if ($name == 'user_default.png'){
            return asset('image/'. $name);
        }
        return asset('storage/user/profile_images/' . $name);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->user->getId()->id(),
            'name' => $this->user->getName(),
            'profile_image' => $this->getProfileImageUrl($this->user->getProfileImage()),
            'birthdate' => $this->user->getBirthdate()->format('Y-m-d'),
            'username' => $this->user->getUsername(),
            'gender' => $this->user->getGender()->getValue(),
            'role' => $this->user->getRole()->getValue(),
            'balance' => $this->user->getBalance(),
            'email' => $this->user->getEmail(),
            'address' => $this->user->getAddress(),
            'phone' => $this->user->getPhone(),
        ];
    }
}
