<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\Forum;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlForumRepository implements ForumRepository
{

    /**
     * @throws Exception
     */
    public function byId(ForumId $forumId): ?Forum
    {
        $forum_row = DB::table('forums')->where('id', $forumId->id())->first();

        if ($forum_row === null) {
            return null;
        }

        return $this->convertRowToForum($forum_row);
    }

    /**
     * @throws Exception
     */
    public function convertRowToForum($forum_row): Forum
    {
        $forum = new Forum(
            new ForumId($forum_row->id),
            $forum_row->slug,
            $forum_row->title,
            $forum_row->subtitle,
            $forum_row->content,
            new UserId($forum_row->user_id)
        );
        $forum->setCreatedAt(new DateTime($forum_row->created_at));
        $forum->setUpdatedAt(new DateTime($forum_row->updated_at));
        return $forum;
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

    public function getForumImages(ForumId $forumId): array
    {
        $forum_images_row = DB::table('forum_images')->where('forum_id', $forumId->id())->get();

        $forum_images = [];

        foreach ($forum_images_row as $forum_image_row) {
            $forum_images[] = $forum_image_row->filename;
        }

        return $forum_images;
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

    /**
     * @throws Exception
     */
    public function listForum(int $offset, int $limit): array
    {
        $forums_row = DB::table('forums')
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        $forums = [];

        foreach ($forums_row as $forum) {
            $forums[] = $this->convertRowToForum($forum);
        }

        return $forums;
    }

    /**
     * @throws Exception
     */
    public function listForumByUser(UserId $userId, int $offset, int $limit): array
    {
        $forums_row = DB::table('forums')
            ->where('user_id', $userId->id())
            ->offset($offset)
            ->limit($limit)
            ->orderByDesc('created_at')
            ->get();

        $forums = [];

        foreach ($forums_row as $forum) {
            $forums[] = $this->convertRowToForum($forum);
        }

        return $forums;
    }
}
