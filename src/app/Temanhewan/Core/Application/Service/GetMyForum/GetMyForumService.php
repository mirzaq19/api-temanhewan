<?php

namespace App\Temanhewan\Core\Application\Service\GetMyForum;

use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;

class GetMyForumService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    public function execute(GetMyForumRequest $request): array
    {
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $forums = $this->forumRepository->listForumByUser($userId, $request->getOffset(), $request->getLimit());

        $response = [];

        foreach ($forums as $forum) {
            $forumImages = $this->forumRepository->getForumImages($forum->getId());
            $response[] = new GetMyForumResponse($forum, $forumImages);
        }

        return $response;
    }
}
