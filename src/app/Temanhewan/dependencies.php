<?php

use Illuminate\Contracts\Foundation\Application;

use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;

use App\Temanhewan\Infrastructure\Repository\SqlUserRepository;
use App\Temanhewan\Infrastructure\Repository\SqlPetRepository;
use App\Temanhewan\Infrastructure\Repository\SqlForumRepository;

/** @var Application $app */

$app->bind(UserRepository::class, SqlUserRepository::class);
$app->bind(PetRepository::class, SqlPetRepository::class);
$app->bind(ForumRepository::class, SqlForumRepository::class);
