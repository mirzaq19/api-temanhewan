<?php

namespace App\Temanhewan\Core\Application\Service\GetForumComments;

use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentResponse;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetForumCommentsService
{
    public function __construct(
        private UserRepository $userRepository,
        private CommentRepository $commentRepository
    ){}

    public function execute(GetForumCommentsRequest $request): array
    {
        $forumId = new ForumId($request->getForumId());
        $comments = $this->commentRepository->byForumId($forumId);

        $response = [];
        foreach($comments as $comment){
            $commentImages = $this->commentRepository->getCommentImages($comment->getId());
            $user = $this->userRepository->byId($comment->getUserId());
            $response[] = new CreateCommentResponse($comment, $user, $commentImages);
        }

        return $response;
    }
}
