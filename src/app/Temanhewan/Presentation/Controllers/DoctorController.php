<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Temanhewan\Core\Application\Query\GetDoctorList\GetDoctorListInterface;
use App\Temanhewan\Core\Application\Query\GetDoctorReviews\GetDoctorReviewsInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Shared\Service\DBManager;

class DoctorController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private GetDoctorReviewsInterface $getDoctorReviews,
        private GetDoctorListInterface $getDoctorList
    ){ }

    public function getDoctors(Request $request): JsonResponse
    {
        $rules = [
            'offset' => 'required',
            'limit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();

        try {
            $response = $this->getDoctorList->execute(
                $request->input('offset'),
                $request->input('limit')
            );
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }

    public function getReviews(Request $request): JsonResponse
    {
        $rules = [
            'doctor_id' => 'required',
            'all' => 'sometimes',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();

        try {
            $response = $this->getDoctorReviews->execute(
                $request->input("doctor_id"),
                $request->boolean("all")
            );
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }
}
