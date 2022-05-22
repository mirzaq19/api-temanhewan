<?php

namespace App\Temanhewan\Core\Application\Service\ListPet;

use App\Temanhewan\Core\Application\Service\GetPet\GetPetResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\PetRepository;

class ListPetService
{
    public function __construct(
        private PetRepository $petRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(ListPetRequest $request): array
    {
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $pets = $this->petRepository->listPet($userId,$request->getOffset(),$request->getLimit());

        $responses = [];

        foreach($pets as $pet){
            $responses[] = new GetPetResponse($pet);
        }

        return $responses;
    }
}
