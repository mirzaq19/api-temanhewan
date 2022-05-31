<?php

namespace App\Temanhewan\Core\Application\Service\CreateComment;

use Illuminate\Http\UploadedFile;

class CreateCommentRequest
{
    /**
     * @param string $content
     * @param string $forum_id
     * @param UploadedFile[]|null $comment_images
     */
    public function __construct(
        private string $content,
        private string $forum_id,
        private ?array $comment_images

    ){}

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getForumId(): string
    {
        return $this->forum_id;
    }

    /**
     * @return UploadedFile[]|null
     */
    public function getCommentImages(): ?array
    {
        return $this->comment_images;
    }
}
