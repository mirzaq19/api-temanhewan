<?php

namespace App\Temanhewan\Core\Application\Service\LoginUser;

use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginUserService
{
    public function __construct(){ }

    /**
     * @param LoginUserRequest $request
     * @return array
     */
    public function execute(LoginUserRequest $request): array
    {
        try {
            if (Auth::attempt([
                'email' => $request->getEmail(),
                'password' => $request->getPassword()
            ])) {
                $user = Auth::user();
                $token = $user->createToken($user['role'].'-auth')->plainTextToken;
                return [
                    'status' => 200,
                    'response' => [
                        'success' => true,
                        'message' => 'Login Success',
                        'data' => [
                            'user' => $user,
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                        ],
                    ]
                ];
            }
            return [
                'status' => 401,
                'response' => [
                    'success' => false,
                    'message' => 'The email or password is incorrect',
                ]
            ];
        } catch (Exception $e) {
            if (env('APP_DEBUG')) {
                return [
                    'status' => 500,
                    'response' => [
                        'success' => false,
                        'message' => $e->getMessage(),
                    ]
                ];
            }
            return [
                'status' => 500,
                'response' => [
                    'success' => false,
                    'message' => 'Interval server error',
                ]
            ];
        }
    }
}
