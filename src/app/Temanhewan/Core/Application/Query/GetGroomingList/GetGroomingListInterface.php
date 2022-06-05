<?php

namespace App\Temanhewan\Core\Application\Query\GetGroomingList;

interface GetGroomingListInterface
{
    /**
     * @param int $offset
     * @param int $limit
     * @return GetGroomingListDto[]
     */
    public function execute(int $offset, int $limit): array;
}
