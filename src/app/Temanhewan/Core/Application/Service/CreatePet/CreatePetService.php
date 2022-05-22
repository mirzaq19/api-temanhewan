<?php

namespace App\Temanhewan\Core\Application\Service\CreatePet;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\Race;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use DateTime;

class CreatePetService{

    public function __construct(
        private UserRepository $userRepository,
        private PetRepository $petRepository
    ){}

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function execute(CreatePetRequest $request): CreatePetResponse
    {

        // check if user is existed
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->byId($userId);

        if(!$user){
            throw new TemanhewanException("User not found",1006);
        }

        if(!is_null($request->getProfileImage())){
            // Get filename and extension of profile_image
            $extension = $request->getProfileImage()->getClientOriginalExtension();
            $filename = $user->getUsername(). '-' . $request->getRace() . '-' . time(). rand(1,100) . '.' . $extension;

            // Move profile_image to public/pet/profile_images
            Storage::disk('public')->putFileAs('pet/profile_images', $request->getProfileImage(), $filename);
        }else{
            $filename = 'pet_default.png';
        }

        $newPet = $user->addPet(
            $request->getName(),
            $filename,
            $request->getDescription(),
            new Race($request->getRace()),
            new Gender($request->getGender()),
        );

        $this->petRepository->save($newPet);
        return new CreatePetResponse($newPet);
    }
}
