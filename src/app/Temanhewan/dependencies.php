<?php

use Illuminate\Contracts\Foundation\Application;

use App\Temanhewan\Core\Domain\Repository\UserRepository;

use App\Temanhewan\Infrastructure\Repository\SqlUserRepository;

/** @var Application $app */

$app->bind(UserRepository::class, SqlUserRepository::class);
