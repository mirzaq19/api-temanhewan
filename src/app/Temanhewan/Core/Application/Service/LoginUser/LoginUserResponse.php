<?php

namespace App\Temanhewan\Core\Application\Service\LoginUser;

use JsonSerializable;

class LoginUserResponse implements JsonSerializable
{
    public function __construct(
        private mixed $user,
        private string $access_token,
        private string $toke_type,
    ) { }

    public function jsonSerialize()
    {
        return [
            'user' => $this->user,
            'access_token' => $this->access_token,
            'token_type' => $this->toke_type,
        ];
    }
}
{

}
