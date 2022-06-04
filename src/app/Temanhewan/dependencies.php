<?php

use Illuminate\Contracts\Foundation\Application;

// Repository Interface
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;

// Repository Implementation
use App\Temanhewan\Infrastructure\Repository\SqlUserRepository;
use App\Temanhewan\Infrastructure\Repository\SqlPetRepository;
use App\Temanhewan\Infrastructure\Repository\SqlForumRepository;
use App\Temanhewan\Infrastructure\Repository\SqlCommentRepository;
use App\Temanhewan\Infrastructure\Repository\SqlConsultationRepository;

// Query Interface
use App\Temanhewan\Core\Application\Query\GetDoctorReviews\GetDoctorReviewsInterface;
use App\Temanhewan\Core\Application\Query\GetDoctorList\GetDoctorListInterface;
use App\Temanhewan\Core\Application\Query\GetDoctor\GetDoctorInterface;

// Query Implementation
use App\Temanhewan\Infrastructure\Query\SqlGetDoctorReviews;
use App\Temanhewan\Infrastructure\Query\SqlGetDoctorList;
use App\Temanhewan\Infrastructure\Query\SqlGetDoctor;


/** @var Application $app */

// Bind the Repository interface to the implementation.
$app->bind(UserRepository::class, SqlUserRepository::class);
$app->bind(PetRepository::class, SqlPetRepository::class);
$app->bind(ForumRepository::class, SqlForumRepository::class);
$app->bind(CommentRepository::class, SqlCommentRepository::class);
$app->bind(ConsultationRepository::class, SqlConsultationRepository::class);

// Bind the Query interface to the implementation.
$app->bind(GetDoctorReviewsInterface::class, SqlGetDoctorReviews::class);
$app->bind(GetDoctorListInterface::class, SqlGetDoctorList::class);
$app->bind(GetDoctorInterface::class, SqlGetDoctor::class);
