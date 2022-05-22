<?php

namespace App\Temanhewan\Core\Application\Service\DeletePet;

class DeletePetRequest
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
