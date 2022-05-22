<?php

namespace App\Temanhewan\Core\Application\Service\UpdatePet;

use App\Temanhewan\Core\Application\Service\GetPet\GetPetResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\Race;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;

class UpdatePetService
{
    public function __construct(
        private UserRepository $userRepository,
        private PetRepository $petRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(UpdatePetRequest $request): GetPetResponse
    {
        $petId = new PetId($request->getPetId());
        $pet = $this->petRepository->byId($petId);

        if(!$pet)
            throw new TemanhewanException("Pet not found",1013);

        if(auth()->user()->getAuthIdentifier() != $pet->getUserId()->id())
            throw new TemanhewanException("User doesn't has permission to update pet",1014);

        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->byId($userId);

        if(!$user){
            throw new TemanhewanException("User not found",1015);
        }

        $filename = $pet->getProfileImage();
        if($request->getProfileImage()){
            // Get filename and extension of profile_image
            $extension = $request->getProfileImage()->getClientOriginalExtension();
            $filename = $user->getUsername(). '-' . $request->getName() . '-' . time(). rand(1,100) . '.' . $extension;

            // replacing old profile_image with new one
            if ($pet->getProfileImage() != 'pet_default.png') {
                Storage::disk('public')->delete('pet/profile_images/'.$pet->getProfileImage());
            }
            Storage::disk('public')->putFileAs('pet/profile_images', $request->getProfileImage(), $filename);
        }

        $pet->setName($request->getName());
        $pet->setProfileImage($filename);
        $pet->setDescription($request->getDescription());
        $pet->setGender(new Gender($request->getGender()));
        $pet->setRace(new Race($request->getRace()));

        $this->petRepository->update($pet);

        return new GetPetResponse($pet);
    }
}
