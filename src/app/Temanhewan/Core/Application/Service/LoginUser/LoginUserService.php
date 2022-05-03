<?php

namespace App\Temanhewan\Core\Application\Service\LoginUser;

use Illuminate\Support\Facades\Auth;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;

class LoginUserService
{
    /**
     * @param LoginUserRequest $request
     * @return LoginUserResponse
     * @throws TemanhewanException
     */
    public function execute(LoginUserRequest $request): LoginUserResponse
    {
        if (Auth::attempt([
            'email' => $request->getEmail(),
            'password' => $request->getPassword()
        ])) {
            $user = Auth::user();
            $token = $user->createToken($user['role'].'-auth')->plainTextToken;

            return new LoginUserResponse($user, $token,'Bearer');
        }
        throw new TemanhewanException( 'The email or password is incorrect',1005);
    }
}
