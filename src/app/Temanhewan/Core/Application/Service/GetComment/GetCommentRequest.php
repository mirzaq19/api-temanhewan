<?php

namespace App\Temanhewan\Core\Application\Service\GetComment;

class GetCommentRequest
{
    public function __construct(
        private string $comment_id,
    ){}

    /**
     * @return string
     */
    public function getCommentId(): string
    {
        return $this->comment_id;
    }

}
