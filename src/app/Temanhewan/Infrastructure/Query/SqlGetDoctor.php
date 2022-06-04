<?php

namespace App\Temanhewan\Infrastructure\Query;

use App\Temanhewan\Core\Application\Query\GetDoctor\GetDoctorDto;
use App\Temanhewan\Core\Application\Query\GetDoctor\GetDoctorInterface;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use Illuminate\Support\Facades\DB;

class SqlGetDoctor implements GetDoctorInterface
{
    /**
     * @throws TemanhewanException
     */
    public function execute(string $id): GetDoctorDto
    {
        $doctor_row = DB::table('users')
            ->where('id', $id)
            ->where('role','doctor')
            ->first();

        if(!$doctor_row)
            throw new TemanhewanException('Doctor not found',1067);

        $rating = DB::table('consultation_reviews')
                ->where('doctor_id', $id)
                ->avg('rating') ?? 0;

        $count_review = DB::table('consultation_reviews')
            ->where('doctor_id', $id)
            ->count();

        return new GetDoctorDto(
            $doctor_row->id,
            $doctor_row->name,
            $doctor_row->profile_image,
            $doctor_row->email,
            $doctor_row->gender,
            $doctor_row->address,
            $doctor_row->phone,
            $rating,
            $count_review
        );
    }

}
