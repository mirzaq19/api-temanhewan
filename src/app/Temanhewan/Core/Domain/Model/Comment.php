<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class Comment
{
    private CommentId $id;
    private string $content;
    private UserId $user_id;
    private ForumId $forum_id;
    private DateTime $created_at;
    private DateTime $updated_at;

    /**
     * @param CommentId $id
     * @param string $content
     * @param UserId $user_id
     * @param ForumId $forum_id
     */
    public function __construct(CommentId $id, string $content, UserId $user_id, ForumId $forum_id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->forum_id = $forum_id;
    }

    /**
     * @return CommentId
     */
    public function getId(): CommentId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->user_id;
    }

    /**
     * @return ForumId
     */
    public function getForumId(): ForumId
    {
        return $this->forum_id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }



}
