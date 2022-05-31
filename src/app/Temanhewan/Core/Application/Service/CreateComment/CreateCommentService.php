<?php

namespace App\Temanhewan\Core\Application\Service\CreateComment;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;

class CreateCommentService
{
    public function __construct(
        private UserRepository $userRepository,
        private ForumRepository $forumRepository,
        private CommentRepository $commentRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CreateCommentRequest $request): CreateCommentResponse
    {
        // check if user is existed
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->byId($userId);

        if(!$user){
            throw new TemanhewanException("User not found",1026);
        }

        $forumId = new ForumId($request->getForumId());
        $forum = $this->forumRepository->byId($forumId);

        if(!$forum){
            throw new TemanhewanException("Forum not found",1027);
        }

        $comment = $user->addComment(
            $request->getContent(),
            $forum->getId(),
        );

        $this->commentRepository->save($comment);

        if($request->getCommentImages()){
            foreach($request->getCommentImages() as $image){
                // Get filename and extension of profile_image
                $extension = $image->getClientOriginalExtension();
                $filename = time() . rand(1,100) . '.' . $extension;

                // Move comment_image to public/user/comment_images
                Storage::disk('public')->putFileAs('user/comment_images', $image, $filename);
                $this->commentRepository->saveCommentImage($comment->getId(), $filename);
            }
        }

        $newComment = $this->commentRepository->byId($comment->getId());
        $newCommentImages = $this->commentRepository->getCommentImages($comment->getId());
        return new CreateCommentResponse($newComment,$user,$newCommentImages);
    }
}
