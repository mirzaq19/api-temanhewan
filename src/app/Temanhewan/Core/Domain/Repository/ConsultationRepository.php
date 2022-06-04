<?php

namespace App\Temanhewan\Core\Domain\Repository;

use App\Temanhewan\Core\Domain\Model\Consultation;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\UserId;

interface ConsultationRepository
{
    public function ById(ConsultationId $consultationId): ?Consultation;
    public function ByDoctorId(UserId $doctorId): array;
    public function ByCustomerId(UserId $customerId, int $offset, int $limit): array;
    public function save(Consultation $consultation): void;
    public function update(Consultation $consultation): void;
    public function delete(Consultation $consultation): void;
}
