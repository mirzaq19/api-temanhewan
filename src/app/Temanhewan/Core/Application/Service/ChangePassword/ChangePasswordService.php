<?php

namespace App\Temanhewan\Core\Application\Service\ChangePassword;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(ChangePasswordRequest $request): void
    {
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->ById($userId);

        if(!$user) throw new TemanhewanException("User not found",1018);

        if(!Hash::check($request->getOldPassword(), $user->getHashPassword())) {
            throw new TemanhewanException('The old password is incorrect.',1019);
        }

        $this->userRepository->changePassword($user, $request->getPassword());
    }
}
