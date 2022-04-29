<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class Pet
{
    private PetId $id;
    private string $name;
    private ?string $profile_image;
    private ?string $description;
    private DateTime $birthdate;
    private Race $race;
    private Gender $gender;
    private UserId $id_user;

    /**
     * @param PetId $id
     * @param string $name
     * @param string|null $profile_image
     * @param string|null $description
     * @param DateTime $birthdate
     * @param Race $race
     * @param Gender $gender
     * @param UserId $id_user
     */
    public function __construct(
        PetId $id,
        string $name,
        ?string $profile_image,
        ?string $description,
        DateTime $birthdate,
        Race $race,
        Gender $gender,
        UserId $id_user)
    {
        $this->id = $id;
        $this->name = $name;
        $this->profile_image = $profile_image;
        $this->description = $description;
        $this->birthdate = $birthdate;
        $this->race = $race;
        $this->gender = $gender;
        $this->id_user = $id_user;
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
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
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
    public function getIdUser(): UserId
    {
        return $this->id_user;
    }
}
