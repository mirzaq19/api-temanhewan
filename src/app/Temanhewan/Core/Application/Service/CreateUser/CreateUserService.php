<?php

namespace App\Temanhewan\Core\Application\Service\CreateUser;

use App\Temanhewan\Core\Domain\Model\User;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;

class CreateUserService
{
    public function __construct(
        private UserRepository $userRepository
    ){ }

    public function execute(CreateUserRequest $request)
    {
        if(!is_null($request->getProfileImage())){
            // Get filename and extension of profile_image
            $extension = $request->getProfileImage()->getClientOriginalExtension();
            $filename = $request->getUsername(). '-' . time(). rand(1,100) . '.' . $extension;

            // Move profile_image to public/user/profile_images
            Storage::disk('public')->putFileAs('user/profile_images', $request->getProfileImage(), $filename);
        }else{
            $filename = 'default.png';
        }

        // Convert request to user
        $user = $this->userRepository->convertRequestToUser($request,$filename);

        // Save user to database
        $this->userRepository->save($user);

    }
}
