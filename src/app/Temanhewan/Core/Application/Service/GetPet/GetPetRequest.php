<?php

namespace App\Temanhewan\Core\Application\Service\GetPet;

class GetPetRequest
{
    public function __construct(
        private string $petId
    ){}

    /**
     * @return string
     */
    public function getPetId(): string
    {
        return $this->petId;
    }
}
