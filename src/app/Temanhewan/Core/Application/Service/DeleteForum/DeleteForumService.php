<?php

namespace App\Temanhewan\Core\Application\Service\DeleteForum;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use Illuminate\Support\Facades\Storage;

class DeleteForumService
{
    public function __construct(
        private ForumRepository $forumRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeleteForumRequest $request)
    {
        $forumId = new ForumId($request->getId());
        $forum = $this->forumRepository->ById($forumId);

        if(!$forum) throw new TemanhewanException("Forum not found", 1021);

        $forumImages = $this->forumRepository->getForumImages($forumId);

        foreach($forumImages as $image) {
            if(Storage::disk('public')->exists('user/forum_images/' . $image)) {
                Storage::disk('public')->delete('user/forum_images/' . $image);
            }
        }

        $this->forumRepository->delete($forum);
    }
}
