<?php

namespace App\Temanhewan\Core\Application\Service\DeleteForum;

class DeleteForumRequest
{
    public function  __construct(
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
