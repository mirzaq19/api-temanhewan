<?php

namespace App\Temanhewan\Core\Application\Service\GetPet;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Repository\PetRepository;

class GetPetService
{
    public function __construct(
        private PetRepository $petRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetPetRequest $request): GetPetResponse
    {
        $petId = new PetId($request->getPetId());
        $pet = $this->petRepository->byId($petId);

        if(!$pet){
            throw new TemanhewanException("Pet doesn't exist",1009);
        }

        return new GetPetResponse($pet);
    }
}
