<?php

namespace App\Temanhewan\Core\Application\Service\CompleteGroomingOrder;

class CompleteGroomingOrderRequest
{
    public function __construct(
        private string $id
    ){}

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


}
