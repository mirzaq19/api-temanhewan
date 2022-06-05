<?php

namespace App\Temanhewan\Core\Domain\Model;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;

use DateTime;
use Ramsey\Uuid\Type\Time;

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
     * Add pet to user
     * @param string $name
     * @param string $profile_image
     * @param string|null $description
     * @param Race $race
     * @param Gender $gender
     * @return Pet
     */
    public function addPet(
        string $name,
        string $profile_image,
        ?string $description,
        Race $race,
        Gender $gender,
    ): Pet
    {
        return new Pet(
            new PetId(),
            $name,
            $profile_image,
            $description,
            $race,
            $gender,
            $this->getId(),
        );
    }

    /**
     * @param string $title
     * @param string $subtitle
     * @param string $content
     * @return Forum
     */
    public function addForum(string $title, string $subtitle, string $content): Forum
    {
        return new Forum(
            new ForumId(),
            Str::slug(substr($title,0,100)). '-' . rand(1, 1000),
            $title,
            $subtitle,
            $content,
            $this->getId(),
        );
    }

    /**
     * @param string $content
     * @param ForumId $forumId
     * @return Comment
     */
    public function addComment(string $content, ForumId $forumId): Comment
    {
        return new Comment(
            new CommentId(),
            $content,
            $this->getId(),
            $forumId,
        );
    }

    public function addConsultation(
        string $complaint,
        string $address,
        DateTime $date,
        ?int $fee,
        UserId $doctorId
    ): Consultation
    {
        return new Consultation(
            new ConsultationId(),
            $complaint,
            $address,
            $date,
            $fee,
            new ConsultationStatus(ConsultationStatus::PENDING),
            $this->getId(),
            $doctorId,
        );
    }

    public function addGroomingService(
        string $name,
        string $description,
        int $price,
        UserId $groomingId
    ): GroomingService
    {
        return new GroomingService(
            new GroomingServiceId(),
            $name,
            $description,
            $price,
            $this->getId(),
        );
    }

    public function addGroomingOrder(
        string $address,
        GroomingServiceId $groomingServiceId,
        PetId $petId,
        UserId $groomingId
    ): GroomingOrder
    {
        return new GroomingOrder(
            new GroomingOrderId(),
            $address,
            new GroomingOrderStatus(GroomingOrderStatus::PENDING),
            $groomingServiceId,
            $petId,
            $this->getId(),
            $groomingId,
        );
    }

    /**
     * @param string $hashPassword
     */
    public function setHashPassword(string $hashPassword): void
    {
        $this->hashPassword = $hashPassword;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $profile_image
     */
    public function setProfileImage(?string $profile_image): void
    {
        $this->profile_image = $profile_image;
    }

    /**
     * @param Gender $gender
     */
    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @param DateTime $birthdate
     */
    public function setBirthdate(DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
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
