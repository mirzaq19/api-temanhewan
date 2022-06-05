<?php

namespace App\Temanhewan\Core\Application\Query\GetGroomingReviews;

interface GetGroomingReviewsInterface
{
    /**
     * @param string $grooming_id
     * @param bool|null $all
     * @return GetGroomingReviewsDto[]
     */
    public function execute(string $grooming_id, ?bool $all) : array;
}
