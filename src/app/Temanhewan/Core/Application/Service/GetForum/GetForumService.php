<?php

namespace App\Temanhewan\Core\Application\Service\GetForum;

use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;

class GetForumService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetForumRequest $request): GetMyForumResponse
    {
        $forumId = new ForumId($request->getId());
        $forum = $this->forumRepository->byId($forumId);

        if(!$forum) {
            throw new TemanhewanException("Forum not found",1020);
        }

        $forumImages = $this->forumRepository->getForumImages($forum->getId());

        return new GetMyForumResponse($forum, $forumImages);
    }
}
