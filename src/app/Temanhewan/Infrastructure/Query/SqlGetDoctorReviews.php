<?php

namespace App\Temanhewan\Infrastructure\Query;

use App\Temanhewan\Core\Application\Query\GetDoctorReviews\GetDoctorReviewsDto;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Temanhewan\Core\Application\Query\GetDoctorReviews\GetDoctorReviewsInterface;

class SqlGetDoctorReviews implements GetDoctorReviewsInterface
{
    /**
     * @throws \Exception
     */
    public function execute(string $doctor_id, ?bool $all) : array
    {
        $doctor_row = DB::table('users')
            ->where('id', $doctor_id)
            ->where('role', 'doctor')
            ->first();

        if(!$doctor_row)
            throw new TemanhewanException('Doctor not found',1068);

        if($all){
            $reviews_row = DB::table('consultation_reviews')
                ->select(DB::Raw('consultation_reviews.id, rating, review, is_public, customer_id, users.name, users.profile_image, consultation_reviews.created_at, consultation_reviews.updated_at'))
                ->where('doctor_id', $doctor_id)
                ->join('users', 'consultation_reviews.customer_id', '=', 'users.id')
                ->get();

        } else{
            $reviews_row = DB::table('consultation_reviews')
                ->select(DB::Raw('consultation_reviews.id, rating, review, is_public, customer_id, users.name, users.profile_image, consultation_reviews.created_at, consultation_reviews.updated_at'))
                ->where('doctor_id', $doctor_id)
                ->where('is_public', true)
                ->join('users', 'consultation_reviews.customer_id', '=', 'users.id')
                ->get();
        }

        $reviews = [];
        foreach ($reviews_row as $review_row) {
            $created_at = new DateTime($review_row->created_at);
            $updated_at = new DateTime($review_row->updated_at);
            $reviews[] = new GetDoctorReviewsDto(
                $review_row->id,
                $review_row->rating,
                $review_row->review,
                $review_row->is_public,
                $review_row->customer_id,
                $review_row->name,
                $review_row->profile_image,
                $created_at->format('Y-m-d H:i:s'),
                $updated_at->format('Y-m-d H:i:s'),
            );
        }

        return $reviews;
    }
}
