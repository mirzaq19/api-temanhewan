<?php

namespace App\Temanhewan\Core\Application\Service\CreateForum;

use Illuminate\Http\UploadedFile;

class CreateForumRequest
{

    /**
     * @param string $title
     * @param string $subtitle
     * @param string $content
     * @param UploadedFile[]|null $forum_images
     */
    public function __construct(
        private string $title,
        private string $subtitle,
        private string $content,
        private ?array $forum_images,
    ){}

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
     * @return UploadedFile[]|null
     */
    public function getForumImages(): ?array
    {
        return $this->forum_images;
    }
}
