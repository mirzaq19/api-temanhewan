<?php

namespace App\Temanhewan\Core\Domain\Model;

use DateTime;

class Forum
{
    private ForumId $id;
    private string $slug;
    private string $title;
    private string $subtitle;
    private string $content;
    private UserId $user_id;
    private DateTime $created_at;
    private DateTime $updated_at;

    /**
     * @param ForumId $id
     * @param string $slug
     * @param string $title
     * @param string $subtitle
     * @param string $content
     * @param UserId $user_id
     */
    public function __construct(ForumId $id, string $slug, string $title, string $subtitle, string $content, UserId $user_id)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->content = $content;
        $this->user_id = $user_id;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
    public function getId(): ForumId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


}
