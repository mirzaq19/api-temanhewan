<?php

namespace App\Temanhewan\Core\Application\Service\LoginUser;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Cookie\CookieJar;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Cookie;

class LoginUserResponse implements JsonSerializable
{
    public function __construct(
        private mixed $user,
        private string $access_token,
        private string $toke_type,
    ) { }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return CookieJar|Cookie|Application
     */
    public function createCookies(): CookieJar|Cookie|Application
    {
        return cookie('jwt', $this->getAccessToken(), (1440 * 7));
    }

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
