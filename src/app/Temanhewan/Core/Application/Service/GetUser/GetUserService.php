<?php

namespace App\Temanhewan\Core\Application\Service\GetUser;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetUserService
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(): GetUserResponse
    {
        $userId = new UserId(auth()->user()->getAuthIdentifier());
        $user = $this->userRepository->byId($userId);

        if(!$user) throw new TemanhewanException("User not found",1012);

        return new GetUserResponse($user);
    }
}
