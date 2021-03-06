<?php

namespace App\Temanhewan\Core\Application\Service\CreatePet;

use Illuminate\Http\UploadedFile;

class CreatePetRequest{
    public function __construct(
        public string $name,
        public ?UploadedFile $profile_image,
        public ?string $description,
        public string $race,
        public string $gender,
    ){}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return UploadedFile|null
     */
    public function getProfileImage(): ?UploadedFile
    {
        return $this->profile_image;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }
}
