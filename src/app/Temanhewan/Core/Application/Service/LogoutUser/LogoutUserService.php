<?php

namespace App\Temanhewan\Core\Application\Service\LogoutUser;

use Illuminate\Support\Facades\Auth;

class LogoutUserService
{
    public function execute()
    {
        Auth::user()->currentAccessToken()->delete();
        return 'User Logout Successfully';
    }
}
