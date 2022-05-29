<?php

namespace App\Temanhewan\Core\Application\Service\GetPublicForum;

use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumResponse;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;

class GetPublicForumService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    public function execute(GetPublicForumRequest $request): array
    {
        $forums = $this->forumRepository->listForum($request->getOffset(), $request->getLimit());

        $response = [];
        foreach ($forums as $forum) {
            $forumImages = $this->forumRepository->getForumImages($forum->getId());
            $response[] = new GetMyForumResponse($forum,$forumImages);
        }

        return $response;
    }
}
