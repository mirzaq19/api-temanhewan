<?php

namespace App\Temanhewan\Core\Application\Service\DeleteComment;

use App\Temanhewan\Core\Domain\Model\CommentId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use Illuminate\Support\Facades\Storage;

class DeleteCommentService
{
    public function __construct(
        private CommentRepository $commentRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeleteCommentRequest $request): void
    {
        $commentId = new CommentId($request->getCommentId());
        $comment = $this->commentRepository->ById($commentId);

        if(!$comment) throw new TemanhewanException("Comment not found", 1029);

        if($comment->getUserId()->id() !== auth()->user()->getAuthIdentifier())
            throw new TemanhewanException("You are not allowed to delete this comment", 1030);

        $commentImages = $this->commentRepository->getCommentImages($commentId);

        foreach($commentImages as $image) {
            if(Storage::disk('public')->exists('user/comment_images/' . $image)) {
                Storage::disk('public')->delete('user/comment_images/' . $image);
            }
        }

        $this->commentRepository->remove($comment);
    }
}
