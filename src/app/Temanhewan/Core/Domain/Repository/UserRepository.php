<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\User;
use App\Temanhewan\Core\Domain\Model\UserId;

interface UserRepository
{
    public function byId(UserId $id): ?User;
}
