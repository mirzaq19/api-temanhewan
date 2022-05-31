<?php

namespace App\Temanhewan\Core\Application\Service\UpdateComment;

use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\CommentId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Storage;

class UpdateCommentService
{
    public function __construct(
        private UserRepository $userRepository,
        private CommentRepository $commentRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(UpdateCommentRequest $request)
    {
        $commentId = new CommentId($request->getCommentId());
        $comment = $this->commentRepository->ById($commentId);

        if (!$comment) {
            throw new TemanhewanException('Comment not found',1031);
        }

        if ($comment->getUserId()->id() !== auth()->user()->getAuthIdentifier()) {
            throw new TemanhewanException('You are not allowed to update this comment',1032);
        }

        $comment->setContent($request->getContent());
        $this->commentRepository->update($comment);

        if($request->getCommentImages()){
            foreach($request->getCommentImages() as $image){
                // Get filename and extension of profile_image
                $extension = $image->getClientOriginalExtension();
                $filename = time() . rand(1,100) . '.' . $extension;

                // Move comment images to public/user/comment_images
                Storage::disk('public')->putFileAs('user/comment_images', $image, $filename);
                $this->commentRepository->saveCommentImage($comment->getId(), $filename);
            }
        }

        $updatedComment = $this->commentRepository->ById($commentId);
        $updatedCommentImages = $this->commentRepository->getCommentImages($commentId);
        $user = $this->userRepository->ById($comment->getUserId());
        return new CreateCommentResponse($updatedComment,$user,$updatedCommentImages);
    }
}
