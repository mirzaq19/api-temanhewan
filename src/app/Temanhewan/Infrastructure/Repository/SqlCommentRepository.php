<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\Comment;
use App\Temanhewan\Core\Domain\Model\CommentId;
use App\Temanhewan\Core\Domain\Model\ForumId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlCommentRepository implements CommentRepository
{
    /**
     * @throws Exception
     */
    public function ById(CommentId $id): ?Comment
    {
        $comment_row = DB::table('comments')->where('id', $id->id())->first();

        if ($comment_row === null) {
            return null;
        }

        return $this->convertRowToComment($comment_row);
    }

    /**
     * @throws Exception
     */
    public function convertRowToComment($comment_row): Comment
    {
        $comment = new Comment(
            new CommentId($comment_row->id),
            $comment_row->content,
            new UserId($comment_row->user_id),
            new ForumId($comment_row->forum_id)
        );
        $comment->setCreatedAt(new DateTime($comment_row->created_at));
        $comment->setUpdatedAt(new DateTime($comment_row->updated_at));
        return $comment;
    }

    /**
     * @throws Exception
     */
    public function ByForumId(ForumId $forumId): array
    {
        $comment_rows = DB::table('comments')
            ->where('forum_id', $forumId->id())
            ->orderByDesc('created_at')
            ->get();

        $comments = [];
        foreach ($comment_rows as $comment_row) {
            $comments[] = $this->convertRowToComment($comment_row);
        }

        return $comments;
    }

    public function save(Comment $comment): void
    {
        DB::table('comments')->insert([
            'id' => $comment->getId()->id(),
            'content' => $comment->getContent(),
            'user_id' => $comment->getUserId()->id(),
            'forum_id' => $comment->getForumId()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function saveCommentImage(CommentId $commentId, string $filename): void
    {
        DB::table('comment_images')->insert([
            'filename' => $filename,
            'comment_id' => $commentId->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function getCommentImages(CommentId $commentId): array
    {
        $comment_images_row = DB::table('comment_images')->where('comment_id', $commentId->id())->get();

        $comment_images = [];

        foreach ($comment_images_row as $comment_image_row) {
            $comment_images[] = $comment_image_row->filename;
        }

        return $comment_images;
    }

    public function remove(Comment $comment): void
    {
        DB::table('comments')
            ->where('id', $comment->getId()->id())
            ->delete();

        DB::table('comment_images')
            ->where('comment_id', $comment->getId()->id())
            ->delete();
    }
}
