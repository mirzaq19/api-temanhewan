<?php

namespace App\Temanhewan\Core\Application\Service\CompleteConsultation;

class CompleteConsultationRequest
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
