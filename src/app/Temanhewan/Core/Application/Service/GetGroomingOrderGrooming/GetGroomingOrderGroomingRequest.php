<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingOrderGrooming;

class GetGroomingOrderGroomingRequest
{
    public function __construct(
        private string $grooming_id,
        private int $offset,
        private int $limit
    ){}

    /**
     * @return string
     */
    public function getGroomingId(): string
    {
        return $this->grooming_id;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }


}
