<?php

namespace App\Temanhewan\Core\Domain\Model;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;

use DateTime;

class User implements Authenticatable
{
    use HasApiTokens;

    private UserId $id;
    private string $name;
    private ?string $rememberToken;
    private ?string $profile_image;
    private DateTime $birthdate;
    private string $username;
    private Gender $gender;
    private Role $role;
    private int $balance;
    private string $email;
    private string $hashPassword;
    private string $address;
    private string $phone;

    /**
     * @param UserId $id
     * @param string $name
     * @param string|null $profile_image
     * @param DateTime $birthdate
     * @param string $username
     * @param Gender $gender
     * @param Role $role
     * @param int $balance
     * @param string $email
     * @param string $hashPassword
     * @param string $address
     * @param string $phone
     */
    public function __construct(
        UserId $id,
        string $name,
        ?string $profile_image,
        DateTime $birthdate,
        string $username,
        Gender $gender,
        Role $role,
        int $balance,
        string $email,
        string $hashPassword,
        string $address,
        string $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->profile_image = $profile_image;
        $this->birthdate = $birthdate;
        $this->username = $username;
        $this->gender = $gender;
        $this->role = $role;
        $this->balance = $balance;
        $this->email = $email;
        $this->hashPassword = $hashPassword;
        $this->address = $address;
        $this->phone = $phone;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * Add pet to user
     * @param string $name
     * @param string $profile_image
     * @param string $description
     * @param DateTime $birthdate
     * @param Race $race
     * @param Gender $gender
     * @return Pet
     */
    public function addPet(
        string $name,
        string $profile_image,
        string $description,
        DateTime $birthdate,
        Race $race,
        Gender $gender,
    ): Pet
    {
        return new Pet(
            new PetId(),
            $name,
            $profile_image,
            $description,
            $birthdate,
            $race,
            $gender,
            $this->getId(),
        );
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getProfileImage(): ?string
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
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
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
    public function getHashPassword(): string
    {
        return $this->hashPassword;
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

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier():string
    {
        return $this->getId()->id();
    }

    public function getAuthPassword():string
    {
        return $this->getHashPassword();
    }

    public function getRememberToken():?string
    {
        return $this->rememberToken;
    }

    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    public function getRememberTokenName():string
    {
        return '';
    }
}
