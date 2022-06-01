<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Domain\Model\Consultation;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlConsultationRepository implements ConsultationRepository
{
    /**
     * @throws Exception
     */
    public function convertRowToConsultation($consultation_row): Consultation
    {
        $consultation = new Consultation(
            new ConsultationId($consultation_row->id),
            $consultation_row->complaint,
            $consultation_row->address,
            new DateTime($consultation_row->date),
            $consultation_row->fee,
            new ConsultationStatus($consultation_row->status),
            new UserId($consultation_row->customer_id),
            new UserId($consultation_row->doctor_id)
        );
        $consultation->setCreatedAt(new DateTime($consultation_row->created_at));
        $consultation->setUpdatedAt(new DateTime($consultation_row->updated_at));
        return $consultation;
    }

    public function accept(Consultation $consultation): void
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'fee' => $consultation->getFee(),
                'status' => ConsultationStatus::ACCEPTED,
                'updated_at' => now()
            ]);
    }

    public function cancel(Consultation $consultation): void
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'status' => ConsultationStatus::CANCELLED,
                'updated_at' => now()
            ]);
    }

    public function reject(Consultation $consultation): void
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'status' => ConsultationStatus::REJECTED,
                'updated_at' => now()
            ]);
    }

    public function paid(Consultation $consultation)
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'status' => ConsultationStatus::PAID,
                'updated_at' => now()
            ]);
    }

    public function complete(Consultation $consultation)
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'status' => ConsultationStatus::COMPLETED,
                'updated_at' => now()
            ]);
    }

    /**
     * @throws Exception
     */
    public function ById(ConsultationId $consultationId): ?Consultation
    {
        $consultation_row = DB::table('consultations')
            ->where('id', $consultationId->id())
            ->first();

        if ($consultation_row === null) {
            return null;
        }

        return $this->convertRowToConsultation($consultation_row);
    }

    /**
     * @throws Exception
     */
    public function ByDoctorId(UserId $doctorId): array
    {
        $consultation_rows = DB::table('consultations')
            ->where('doctor_id', $doctorId->id())
            ->get();

        $consultations = [];
        foreach ($consultation_rows as $consultation_row) {
            $consultations[] = $this->convertRowToConsultation($consultation_row);
        }

        return $consultations;
    }

    /**
     * @throws Exception
     */
    public function ByCustomerId(UserId $customerId): array
    {
        $consultation_rows = DB::table('consultations')
            ->where('customer_id', $customerId->id())
            ->get();

        $consultations = [];
        foreach ($consultation_rows as $consultation_row) {
            $consultations[] = $this->convertRowToConsultation($consultation_row);
        }

        return $consultations;
    }

    public function save(Consultation $consultation): void
    {
        DB::table('consultations')->insert([
            'id' => $consultation->getId()->id(),
            'complaint' => $consultation->getComplaint(),
            'address' => $consultation->getAddress(),
            'date' => $consultation->getDate(),
            'fee' => $consultation->getFee(),
            'status' => $consultation->getStatus()->getValue(),
            'customer_id' => $consultation->getCustomerId()->id(),
            'doctor_id' => $consultation->getDoctorId()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update(Consultation $consultation): void
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->update([
                'complaint' => $consultation->getComplaint(),
                'address' => $consultation->getAddress(),
                'date' => $consultation->getDate(),
                'fee' => $consultation->getFee(),
                'status' => $consultation->getStatus()->getValue(),
                'updated_at' => now(),
            ]);
    }

    public function delete(Consultation $consultation): void
    {
        DB::table('consultations')
            ->where('id', $consultation->getId()->id())
            ->delete();
    }
}
