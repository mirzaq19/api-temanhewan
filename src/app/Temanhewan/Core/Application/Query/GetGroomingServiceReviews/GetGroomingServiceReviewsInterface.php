<?php

namespace App\Temanhewan\Core\Application\Query\GetGroomingServiceReviews;

interface GetGroomingServiceReviewsInterface
{
    /**
     * @param string $grooming_service_id
     * @param bool|null $all
     * @return GetGroomingServiceReviewsDto[]
     */
    public function execute(string $grooming_service_id, ?bool $all) : array;
}
