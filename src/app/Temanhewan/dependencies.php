<?php

use Illuminate\Contracts\Foundation\Application;

use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;

use App\Temanhewan\Infrastructure\Repository\SqlUserRepository;
use App\Temanhewan\Infrastructure\Repository\SqlPetRepository;

/** @var Application $app */

$app->bind(UserRepository::class, SqlUserRepository::class);
$app->bind(PetRepository::class, SqlPetRepository::class);
