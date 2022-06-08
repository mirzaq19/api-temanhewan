<?php

namespace App\Temanhewan\Core\Application\Service\GetMyComment;

use App\Temanhewan\Core\Application\Service\GetMyComment\GetMyCommentRequest;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentResponse;

class GetMyCommentService
{
    public function __construct(
        private UserRepository $userRepository,
        private CommentRepository $commentRepository
    ){}

    public function execute(GetMyCommentRequest $request): array
    {
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $comments = $this->commentRepository->listCommentByUser($userId, $request->getOffset(), $request->getLimit());

        $user = $this->userRepository->byId($userId);

        $response = [];

        foreach ($comments as $comment) {
            $commentImages = $this->commentRepository->getCommentImages($comment->getId());
            $response[] = new CreateCommentResponse($comment,$user,$commentImages);
        }

        return $response;
    }
}
