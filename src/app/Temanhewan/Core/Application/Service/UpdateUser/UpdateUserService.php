<?php

namespace App\Temanhewan\Core\Application\Service\UpdateUser;

use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateUserService
{
    public function __construct(
        private UserRepository $userRepository
    ){ }

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function execute(UpdateUserRequest $request)
    {
        // check if user exist
        $userId = new userId($request->getId());
        $user = $this->userRepository->ById($userId);
        if(!$user){
            throw new TemanhewanException("User not found",1007);
        }

        // update profile_image if provided
        $filename = $user->getProfileImage();
        if($request->getProfileImage()){
            // Get filename and extension of profile_image
            $extension = $request->getProfileImage()->getClientOriginalExtension();
            $filename = $user->getUsername(). '-' . time(). rand(1,100) . '.' . $extension;

            // replacing old profile_image with new one
            if ($user->getProfileImage() != 'default.png') {
                Storage::disk('public')->delete('user/profile_images/'.$user->getProfileImage());
            }
            Storage::disk('public')->putFileAs('user/profile_images', $request->getProfileImage(), $filename);
        }

        $user->setName($request->getName());
        $user->setProfileImage($filename);
        $user->setBirthdate(new DateTime($request->getBirthdate()));
        $user->setHashpassword($request->getPassword() ? Hash::make($request->getPassword()) : $user->getHashPassword());
        $user->setAddress($request->getAddress());
        $user->setPhone($request->getPhone());

        $this->userRepository->update($user);
    }
}
