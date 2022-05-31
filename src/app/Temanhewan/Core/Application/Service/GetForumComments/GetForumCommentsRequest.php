<?php

namespace App\Temanhewan\Core\Application\Service\GetForumComments;

class GetForumCommentsRequest
{
    public function __construct(
        private string $forum_id
    ){}

    /**
     * @return string
     */
    public function getForumId(): string
    {
        return $this->forum_id;
    }
}
