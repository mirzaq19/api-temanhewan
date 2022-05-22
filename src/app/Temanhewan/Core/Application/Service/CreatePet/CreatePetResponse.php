<?php

namespace App\Temanhewan\Core\Application\Service\CreatePet;

use App\Temanhewan\Core\Domain\Model\Pet;
use JsonSerializable;

class CreatePetResponse implements JsonSerializable
{
    public function  __construct(
      private Pet $pet
    ){}

    public function getProfileImageUrl(string $name): string
    {
        if ($name == 'pet_default.png'){
            return asset('image/'. $name);
        }
        return asset('storage/pet/profile_images/' . $name);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->pet->getId()->id(),
            'name' => $this->pet->getName(),
            'description' => $this->pet->getDescription(),
            'gender' => $this->pet->getGender()->getValue(),
            'race' => $this->pet->getRace()->getValue(),
            'profile_image' => $this->getProfileImageUrl($this->pet->getProfileImage()),
        ];
    }
}
