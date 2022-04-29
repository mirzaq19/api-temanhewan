<?php

namespace App\Temanhewan\Core\Application\Service\CreateUser;

use DateTime;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\Role;
use Illuminate\Http\UploadedFile;

class CreateUserRequest
{
    public function __construct(
        private string $name,
        private ?UploadedFile $profile_image,
        private DateTime $birthdate,
        private string $username,
        private Gender $gender,
        private Role $role,
        private string $email,
        private string $password,
        private string $address,
        private string $phone
    ){}

    /**
     * @return DateTime
     */
    public function getBirthDate(): DateTime
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
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
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
