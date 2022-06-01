<?php

namespace App\Temanhewan\Core\Application\Service\GetPublicUser;

use App\Temanhewan\Core\Application\Service\GetUser\GetUserResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetPublicUserService
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetPublicUserRequest $request)
    {
        $userId = new UserId($request->getId());
        $user = $this->userRepository->ById($userId);

        if(!$user) throw new TemanhewanException("User not found",1034);

        return new GetUserResponse($user);
    }
}
