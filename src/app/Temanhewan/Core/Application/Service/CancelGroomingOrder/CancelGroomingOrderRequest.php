<?php

namespace App\Temanhewan\Core\Application\Service\CancelGroomingOrder;

class CancelGroomingOrderRequest
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
