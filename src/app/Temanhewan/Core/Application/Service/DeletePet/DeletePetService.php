<?php

namespace App\Temanhewan\Core\Application\Service\DeletePet;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use Illuminate\Support\Facades\Storage;

class DeletePetService
{
    public function __construct(
        private PetRepository $petRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeletePetRequest $request): void
    {
        $petId = new PetId($request->getPetId());
        $pet = $this->petRepository->byId($petId);

        // Check if pet exist
        if(!$pet)
            throw new TemanhewanException("Pet doesn't exist",1010);

        // Check user has permission to delete pet
        if(auth()->user()->getAuthIdentifier() != $pet->getUserId()->id())
            throw new TemanhewanException("This user doesn't has permission to delete pet",1011);

        if($pet->getProfileImage() != 'pet_default.png' && Storage::disk('public')->exists('pet/profile_images/' . $pet->getProfileImage())){
            Storage::disk('public')->delete('pet/profile_images/' . $pet->getProfileImage());
        }

        $this->petRepository->delete($pet);
    }
}
