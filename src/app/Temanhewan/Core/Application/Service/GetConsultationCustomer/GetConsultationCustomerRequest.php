<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultationCustomer;

class GetConsultationCustomerRequest
{
    public function __construct(
        private string $customer_id,
        private int $offset,
        private int $limit
    ){}

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customer_id;
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
