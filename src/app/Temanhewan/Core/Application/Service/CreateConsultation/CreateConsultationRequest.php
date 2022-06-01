<?php

namespace App\Temanhewan\Core\Application\Service\CreateConsultation;

class CreateConsultationRequest
{
    public function __construct(
        private string $complaint,
        private string $address,
        private string $date,
        private string $doctor_id
    ){}

    /**
     * @return string
     */
    public function getComplaint(): string
    {
        return $this->complaint;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDoctorId(): string
    {
        return $this->doctor_id;
    }
}
