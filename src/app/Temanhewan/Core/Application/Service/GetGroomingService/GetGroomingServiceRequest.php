<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingService;

class GetGroomingServiceRequest
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
