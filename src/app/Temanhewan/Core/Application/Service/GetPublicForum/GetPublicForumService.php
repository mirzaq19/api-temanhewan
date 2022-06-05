<?php

namespace App\Temanhewan\Core\Application\Service\GetPublicForum;

use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumResponse;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetPublicForumService
{
    public function __construct(
        private UserRepository $userRepository,
        private ForumRepository $forumRepository
    ){}

    public function execute(GetPublicForumRequest $request): array
    {
        $forums = $this->forumRepository->listForum($request->getOffset(), $request->getLimit());

        $response = [];
        foreach ($forums as $forum) {
            $user = $this->userRepository->byId($forum->getUserId());
            $forumImages = $this->forumRepository->getForumImages($forum->getId());
            $response[] = new GetMyForumResponse($user,$forum,$forumImages);
        }

        return $response;
    }
}
