<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\AcceptConsultation\AcceptConsultationRequest;
use App\Temanhewan\Core\Application\Service\AcceptConsultation\AcceptConsultationService;
use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationRequest;
use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationService;
use App\Temanhewan\Core\Application\Service\PaidConsultation\PaidConsultationRequest;
use App\Temanhewan\Core\Application\Service\PaidConsultation\PaidConsultationService;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){ }

    public function createConsultation(Request $request): JsonResponse
    {
        $rules = [
            'complaint' => 'required',
            'address' => 'required',
            'date' => 'required|date',
            'time' => ['required', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'doctor_id' => 'required|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateConsultationRequest(
            complaint: $request->input("complaint"),
            address: $request->input("address"),
            date: $request->input("date").'T'.$request->input("time"),
            doctor_id: $request->input("doctor_id")
        );

        $service = new CreateConsultationService(
            $this->userRepository,
            $this->consultationRepository,
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }

    public function acceptConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'fee' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new AcceptConsultationRequest(
            id: $request->input("id"),
            fee: $request->input("fee")
        );

        $service = new AcceptConsultationService(
            $this->userRepository,
            $this->consultationRepository,
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }

    public function paidConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new PaidConsultationRequest(
            id: $request->input("id"),
        );

        $service = new PaidConsultationService(
            $this->userRepository,
            $this->consultationRepository,
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }
}
