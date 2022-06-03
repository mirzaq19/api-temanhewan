<?php

namespace App\Temanhewan\Core\Application\Service\CreateConsultationReview;

use App\Temanhewan\Core\Domain\Model\ConsultationReview;
use JsonSerializable;

class CreateConsultationReviewResponse implements JsonSerializable
{
    public function __construct(
        private ConsultationReview $consultationReview
    ){}


    public function jsonSerialize()
    {
        return [
            'id' => $this->consultationReview->getId(),
            'rating' => $this->consultationReview->getRating(),
            'review' => $this->consultationReview->getReview(),
            'is_public' => $this->consultationReview->isPublic(),
            'customer_id' => $this->consultationReview->getCustomerId()->id(),
            'doctor_id' => $this->consultationReview->getDoctorId()->id(),
            'consultation_id' => $this->consultationReview->getConsultationId()->id(),
            'created_at' => $this->consultationReview->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->consultationReview->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
