<?php

namespace App\Temanhewan\Core\Application\Service\CreateUser;

use Illuminate\Http\UploadedFile;

class CreateUserRequest
{
    public function __construct(
        private string $name,
        private ?UploadedFile $profile_image,
        private string $birthdate,
        private string $username,
        private string $gender,
        private string $role,
        private string $email,
        private string $password,
        private string $address,
        private string $phone
    ){}

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthdate;
    }

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
    public function getUsername(): string
    {
        return $this->username;
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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
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
