<?php

namespace App\Temanhewan\Core\Application\Service\UpdateComment;

class UpdateCommentRequest
{
    public function __construct(
        private string $comment_id,
        private string $content,
        private ?array $comment_images
    ){}

    /**
     * @return array|null
     */
    public function getCommentImages(): ?array
    {
        return $this->comment_images;
    }

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
    public function getCommentId(): string
    {
        return $this->comment_id;
    }

}
