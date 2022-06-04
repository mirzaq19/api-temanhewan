<?php

namespace App\Temanhewan\Core\Application\Query\GetDoctor;

interface GetDoctorInterface
{
    public function execute(string $id): GetDoctorDto;
}
