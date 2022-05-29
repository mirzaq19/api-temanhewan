<?php

namespace App\Temanhewan\Core\Application\Service\UpdateForum;

use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use Illuminate\Support\Facades\Storage;

class UpdateForumService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(UpdateForumRequest $request): GetMyForumResponse
    {
        $forumId = new ForumId($request->getId());
        $forum = $this->forumRepository->ById($forumId);

        if(!$forum) throw new TemanhewanException("Forum not found", 1022);

        if(auth()->user()->getAuthIdentifier() != $forum->getUserId()->id()){
            throw new TemanhewanException("You are not allowed to update this forum", 1023);
        }

        $forum->setTitle($request->getTitle());
        $forum->setSubtitle($request->getSubtitle());
        $forum->setContent($request->getContent());

        $this->forumRepository->update($forum);

        if($request->getForumImages()){
            foreach($request->getForumImages() as $image){
                // Get filename and extension of profile_image
                $extension = $image->getClientOriginalExtension();
                $filename = time() . rand(1,100) . '.' . $extension;

                // Move forum images to public/user/forum_images
                Storage::disk('public')->putFileAs('user/forum_images', $image, $filename);
                $this->forumRepository->saveForumImage($forum->getId(), $filename);
            }
        }

        $updatedForum = $this->forumRepository->ById($forum->getId());
        $updatedForumImages = $this->forumRepository->getForumImages($forum->getId());
        return new GetMyForumResponse($updatedForum, $updatedForumImages);
    }
}
