<?php

namespace App\Temanhewan\Core\Application\Query\GetDoctorList;

interface GetDoctorListInterface
{
    /**
     * @param int $offset
     * @param int $limit
     * @return GetDoctorListDto[]
     */
    public function execute(int $offset, int $limit): array;
}
