<?php

namespace App\Temanhewan\Core\Application\Service\CreateForum;

use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;

class CreateForumService
{
    public function __construct(
        private UserRepository $userRepository,
        private ForumRepository $forumRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CreateForumRequest $request)
    {
        // check if user is existed
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->byId($userId);

        if(!$user){
            throw new TemanhewanException("User not found",1017);
        }

        // Create forum
        $forum = $user->addForum(
            $request->getTitle(),
            $request->getSubtitle(),
            $request->getContent(),
        );

        // Save forum
        $this->forumRepository->save($forum);

        if(!is_null($request->getForumImages())){
            foreach($request->getForumImages() as $image){
                // Get filename and extension of profile_image
                $extension = $image->getClientOriginalExtension();
                $filename = time() . rand(1,100) . '.' . $extension;

                // Move profile_image to public/user/profile_images
                Storage::disk('public')->putFileAs('user/forum_images', $image, $filename);
                $this->forumRepository->saveForumImage($forum->getId(), $filename);
            }
        }

        $newForum = $this->forumRepository->byId($forum->getId());
        $newForumImages = $this->forumRepository->getForumImages($forum->getId());
        return new GetMyForumResponse($newForum, $newForumImages);
    }
}
