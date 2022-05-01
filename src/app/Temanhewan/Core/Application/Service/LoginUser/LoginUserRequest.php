<?php

namespace App\Temanhewan\Core\Application\Service\LoginUser;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest
{
    public function __construct(
        private string $email,
        private string $password
    ){ }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
