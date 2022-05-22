<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class Pet
{
    private PetId $id;
    private string $name;
    private ?string $profile_image;
    private ?string $description;
    private Race $race;
    private Gender $gender;
    private UserId $user_id;

    /**
     * @param PetId $id
     * @param string $name
     * @param string|null $profile_image
     * @param string|null $description
     * @param Race $race
     * @param Gender $gender
     * @param UserId $user_id
     */
    public function __construct(
        PetId $id,
        string $name,
        ?string $profile_image,
        ?string $description,
        Race $race,
        Gender $gender,
        UserId $user_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->profile_image = $profile_image;
        $this->description = $description;
        $this->race = $race;
        $this->gender = $gender;
        $this->user_id = $user_id;
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
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param Race $race
     */
    public function setRace(Race $race): void
    {
        $this->race = $race;
    }

    /**
     * @param Gender $gender
     */
    public function setGender(Gender $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getProfileImage(): ?string
    {
        return $this->profile_image;
    }

    /**
     * @return PetId
     */
    public function getId(): PetId
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Race
     */
    public function getRace(): Race
    {
        return $this->race;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->user_id;
    }
}
