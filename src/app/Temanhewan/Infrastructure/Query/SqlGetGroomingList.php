<?php

namespace App\Temanhewan\Infrastructure\Query;

use App\Temanhewan\Core\Application\Query\GetGroomingList\GetGroomingListDto;
use App\Temanhewan\Core\Application\Query\GetGroomingList\GetGroomingListInterface;
use Illuminate\Support\Facades\DB;

class SqlGetGroomingList implements GetGroomingListInterface
{

    public function execute(int $offset, int $limit): array
    {
        $grooming_rows = DB::table('users')
            ->where('role', '=', 'grooming')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $response = [];
        foreach ($grooming_rows as $grooming_row) {
            $rating = DB::table('grooming_reviews')
                    ->where('grooming_id', '=', $grooming_row->id)
                    ->avg('rating') ?? 0;
            $count_review = DB::table('grooming_reviews')
                ->where('grooming_id', '=', $grooming_row->id)
                ->count();
            $response[] = new GetGroomingListDto(
                $grooming_row->id,
                $grooming_row->name,
                $grooming_row->profile_image,
                $grooming_row->email,
                $grooming_row->gender,
                $grooming_row->address,
                $grooming_row->phone,
                $rating,
                $count_review
            );
        }

        return $response;
    }
}
