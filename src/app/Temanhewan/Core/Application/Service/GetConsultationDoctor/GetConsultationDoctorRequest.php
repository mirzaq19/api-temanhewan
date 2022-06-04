<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultationDoctor;

class GetConsultationDoctorRequest
{
    public function __construct(
        private string $doctor_id,
        private int $offset,
        private int $limit
    ){}

    /**
     * @return string
     */
    public function getDoctorId(): string
    {
        return $this->doctor_id;
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
