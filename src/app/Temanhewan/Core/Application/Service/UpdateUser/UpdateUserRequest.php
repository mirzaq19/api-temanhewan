<?php

namespace App\Temanhewan\Core\Application\Service\UpdateUser;

use Illuminate\Http\UploadedFile;

class UpdateUserRequest
{
    public function __construct(
       private string $name,
       private ?UploadedFile $profile_image,
       private string $gender,
       private string $birthdate,
       private string $address,
       private string $phone
    ){ }

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
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
