<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\Comment;
use App\Temanhewan\Core\Domain\Model\CommentId;
use App\Temanhewan\Core\Domain\Model\ForumId;

interface CommentRepository
{
    public function ById(CommentId $id): ?Comment;
    public function ByForumId(ForumId $forumId): array;
    public function save(Comment $comment): void;
    public function update(Comment $comment): void;
    public function remove(Comment $comment): void;
}
