<?php

namespace App\Temanhewan\Core\Application\Query\GetDoctorReviews;

interface GetDoctorReviewsInterface
{
    /**
     * @param string $doctor_id
     * @param bool|null $all
     * @return GetDoctorReviewsDto[]
     */
    public function execute(string $doctor_id, ?bool $all) : array;
}
