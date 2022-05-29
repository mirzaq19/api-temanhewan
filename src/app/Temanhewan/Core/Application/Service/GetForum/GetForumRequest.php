<?php

namespace App\Temanhewan\Core\Application\Service\GetForum;

class GetForumRequest
{
    public function __construct(
        private string $id
    ){}

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
