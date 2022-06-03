<?php

namespace App\Temanhewan\Infrastructure\Query;

use App\Temanhewan\Core\Application\Query\GetDoctorList\GetDoctorListDto;
use App\Temanhewan\Core\Application\Query\GetDoctorList\GetDoctorListInterface;
use Illuminate\Support\Facades\DB;

class SqlGetDoctorList implements GetDoctorListInterface
{
    public function execute(int $offset, int $limit): array
    {
        $doctors_row = DB::table('users')
            ->where('role', '=', 'doctor')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $doctors = [];
        foreach ($doctors_row as $doctor_row) {
            $rating = DB::table('consultation_reviews')
                ->where('doctor_id', '=', $doctor_row->id)
                ->avg('rating');
            $count_review = DB::table('consultation_reviews')
                ->where('doctor_id', '=', $doctor_row->id)
                ->count();
            $doctors[] = new GetDoctorListDto(
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

        return $doctors;
    }
}
