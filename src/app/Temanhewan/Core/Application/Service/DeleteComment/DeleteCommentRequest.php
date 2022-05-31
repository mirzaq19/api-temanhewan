<?php

namespace App\Temanhewan\Core\Application\Service\DeleteComment;

class DeleteCommentRequest
{
    public function __construct(
        private string $comment_id
    ){}

    /**
     * @return string
     */
    public function getCommentId(): string
    {
        return $this->comment_id;
    }

}
