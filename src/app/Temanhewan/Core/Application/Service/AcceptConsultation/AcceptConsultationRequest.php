<?php

namespace App\Temanhewan\Core\Application\Service\AcceptConsultation;

class AcceptConsultationRequest
{
    public function __construct(
        private string $id,
        private int $fee
    ){}

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
    }

}
