<?php

namespace App\Temanhewan\Core\Application\Service\PaidConsultation;

class PaidConsultationRequest
{
    public function __construct(
        private string $id,
    ){}

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


}
