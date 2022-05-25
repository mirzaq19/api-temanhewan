<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\Forum;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use Illuminate\Support\Facades\DB;

class SqlForumRepository implements ForumRepository
{

    public function byId(ForumId $forumId): ?Forum
    {
        $forum_row = DB::table('forums')->where('id', $forumId->id())->first();

        if ($forum_row === null) {
            return null;
        }

        return $this->convertRowToForum($forum_row);
    }

    public function convertRowToForum($forum_row): Forum
    {
        return new Forum(
            new ForumId($forum_row->id),
            $forum_row->slug,
            $forum_row->title,
            $forum_row->subtitle,
            $forum_row->content,
            new UserId($forum_row->user_id)
        );
    }

    public function saveForumImage(ForumId $forumId, string $filename): void
    {
        DB::table('forum_images')->insert([
            'filename' => $filename,
            'forum_id' => $forumId->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function save(Forum $forum): void
    {
        DB::table('forums')->insert([
            'id' => $forum->getId()->id(),
            'slug' => $forum->getSlug(),
            'title' => $forum->getTitle(),
            'subtitle' => $forum->getSubtitle(),
            'content' => $forum->getContent(),
            'user_id' => $forum->getUserId()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(Forum $forum): void
    {
        DB::table('forums')
            ->where('id', $forum->getId()->id())
            ->update([
                'slug' => $forum->getSlug(),
                'title' => $forum->getTitle(),
                'subtitle' => $forum->getSubtitle(),
                'content' => $forum->getContent(),
                'user_id' => $forum->getUserId()->id(),
                'updated_at' => now(),
            ]);
    }

    public function delete(Forum $forum): void
    {
        DB::table('forums')->delete($forum->getId()->id());
    }

    public function listForum(int $offset, int $limit): array
    {
        $forums_row = DB::table('forums')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $forums = [];

        foreach ($forums_row as $forum) {
            $forums[] = $this->convertRowToForum($forum);
        }

        return $forums;
    }

    public function listForumByUser(UserId $userId, int $offset, int $limit): array
    {
        $forums_row = DB::table('forums')
            ->where('user_id', $userId->id())
            ->offset($offset)
            ->limit($limit)
            ->get();

        $forums = [];

        foreach ($forums_row as $forum) {
            $forums[] = $this->convertRowToForum($forum);
        }

        return $forums;
    }
}
