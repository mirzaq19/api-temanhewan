<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\Forum;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Model\UserId;

interface ForumRepository
{
    public function byId(ForumId $forumId): Forum;
    public function save(Forum $forum): void;
    public function update(Forum $forum): void;
    public function delete(Forum $forum): void;
    public function listForum(int $offset, int $limit): array;
    public function listForumByUser(UserId $userId): array;
}
