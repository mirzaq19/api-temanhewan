<?php

namespace App\Temanhewan\Core\Application\Service\ChangePassword;

class ChangePasswordRequest
{
    public function __construct(
        private string $old_password,
        private string $password
    ){}

    /**
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->old_password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
