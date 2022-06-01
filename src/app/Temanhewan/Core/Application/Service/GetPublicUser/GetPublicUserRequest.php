<?php

namespace App\Temanhewan\Core\Application\Service\GetPublicUser;

class GetPublicUserRequest
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
