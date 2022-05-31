<?php

namespace App\Temanhewan\Core\Application\Service\GetComment;

use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\CommentId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetCommentService
{
    public function __construct(
        private UserRepository $userRepository,
        private CommentRepository $commentRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetCommentRequest $request): CreateCommentResponse
    {
        $commentId = new CommentId($request->getCommentId());
        $comment = $this->commentRepository->ById($commentId);

        if(!$comment){
            throw new TemanhewanException("Comment not found",1028);
        }

        $commentImages = $this->commentRepository->getCommentImages($commentId);

        $user = $this->userRepository->byId($comment->getUserId());

        return new CreateCommentResponse($comment,$user,$commentImages);
    }
}
