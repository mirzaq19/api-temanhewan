<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultation;

use App\Temanhewan\Core\Domain\Model\Consultation;
use JsonSerializable;

class GetConsultationResponse implements JsonSerializable
{
    public function __construct(
        private Consultation $consultation
    ){}

    public function jsonSerialize()
    {
        return [
            'id' => $this->consultation->getId()->id(),
            'complaint' => $this->consultation->getComplaint(),
            'address' => $this->consultation->getAddress(),
            'date' => $this->consultation->getDate()->format('Y-m-d'),
            'time' => $this->consultation->getDate()->format('H:i'),
            'fee' => $this->consultation->getFee(),
            'status' => $this->consultation->getStatus()->getValue(),
            'is_reviewed' => $this->consultation->isReviewed(),
            'customer_id' => $this->consultation->getCustomerId()->id(),
            'doctor_id' => $this->consultation->getDoctorId()->id(),
            'created_at' => $this->consultation->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->consultation->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
