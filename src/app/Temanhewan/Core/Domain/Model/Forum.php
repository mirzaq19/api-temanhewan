<?php

namespace App\Temanhewan\Core\Domain\Model;

class Forum
{
    private ForumId $id;
    private string $slug;
    private string $title;
    private string $subtitle;
    private string $content;
    private UserId $user_id;

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


}
