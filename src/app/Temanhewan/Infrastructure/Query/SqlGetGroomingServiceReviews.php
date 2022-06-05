<?php

namespace App\Temanhewan\Infrastructure\Query;

use App\Temanhewan\Core\Application\Query\GetGroomingServiceReviews\GetGroomingServiceReviewsDto;
use App\Temanhewan\Core\Application\Query\GetGroomingServiceReviews\GetGroomingServiceReviewsInterface;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlGetGroomingServiceReviews implements GetGroomingServiceReviewsInterface
{

    /**
     * @throws Exception
     */
    public function execute(string $grooming_service_id, ?bool $all): array
    {
        $grooming_service_row = DB::table('grooming_services')
            ->where('id', $grooming_service_id)
            ->first();

        if(!$grooming_service_row)
            throw new TemanhewanException('Grooming service not found',1125);

        if($all){
            $reviews_row = DB::table('grooming_reviews')
                ->select(DB::Raw('grooming_reviews.id, rating, review, is_public, customer_id, users.name, users.profile_image, grooming_reviews.created_at, grooming_reviews.updated_at'))
                ->where('grooming_service_id', $grooming_service_id)
                ->join('users', 'grooming_reviews.customer_id', '=', 'users.id')
                ->get();

        } else{
            $reviews_row = DB::table('grooming_reviews')
                ->select(DB::Raw('grooming_reviews.id, rating, review, is_public, customer_id, users.name, users.profile_image, grooming_reviews.created_at, grooming_reviews.updated_at'))
                ->where('grooming_service_id', $grooming_service_id)
                ->where('is_public', true)
                ->join('users', 'grooming_reviews.customer_id', '=', 'users.id')
                ->get();
        }

        $reviews = [];
        foreach ($reviews_row as $review_row) {
            $created_at = new DateTime($review_row->created_at);
            $updated_at = new DateTime($review_row->updated_at);
            $reviews[] = new GetGroomingServiceReviewsDto(
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
