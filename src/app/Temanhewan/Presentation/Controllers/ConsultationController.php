<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\AcceptConsultation\AcceptConsultationRequest;
use App\Temanhewan\Core\Application\Service\AcceptConsultation\AcceptConsultationService;
use App\Temanhewan\Core\Application\Service\CancelConsultation\CancelConsultationRequest;
use App\Temanhewan\Core\Application\Service\CancelConsultation\CancelConsultationService;
use App\Temanhewan\Core\Application\Service\CompleteConsultation\CompleteConsultationRequest;
use App\Temanhewan\Core\Application\Service\CompleteConsultation\CompleteConsultationService;
use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationRequest;
use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationService;
use App\Temanhewan\Core\Application\Service\CreateConsultationReview\CreateConsultationReviewRequest;
use App\Temanhewan\Core\Application\Service\CreateConsultationReview\CreateConsultationReviewService;
use App\Temanhewan\Core\Application\Service\GetConsultation\GetConsultationRequest;
use App\Temanhewan\Core\Application\Service\GetConsultation\GetConsultationService;
use App\Temanhewan\Core\Application\Service\GetConsultationCustomer\GetConsultationCustomerRequest;
use App\Temanhewan\Core\Application\Service\GetConsultationCustomer\GetConsultationCustomerService;
use App\Temanhewan\Core\Application\Service\GetConsultationDoctor\GetConsultationDoctorRequest;
use App\Temanhewan\Core\Application\Service\GetConsultationDoctor\GetConsultationDoctorService;
use App\Temanhewan\Core\Application\Service\GetConsultationReview\GetConsultationReviewRequest;
use App\Temanhewan\Core\Application\Service\GetConsultationReview\GetConsultationReviewService;
use App\Temanhewan\Core\Application\Service\PaidConsultation\PaidConsultationRequest;
use App\Temanhewan\Core\Application\Service\PaidConsultation\PaidConsultationService;
use App\Temanhewan\Core\Application\Service\RejectConsultation\RejectConsultationRequest;
use App\Temanhewan\Core\Application\Service\RejectConsultation\RejectConsultationService;
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

    public function getConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetConsultationRequest(
            id: $request->input("id"),
        );

        $service = new GetConsultationService(
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

    public function getConsultationByCustomer(Request $request): JsonResponse
    {
        $rules = [
            'customer_id' => 'required',
            'offset' => 'required',
            'limit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetConsultationCustomerRequest(
            customer_id: $request->input("customer_id"),
            offset: $request->input("offset"),
            limit: $request->input("limit"),
        );

        $service = new GetConsultationCustomerService(
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

    public function getConsultationByDoctor(Request $request): JsonResponse
    {
        $rules = [
            'doctor_id' => 'required',
            'offset' => 'required',
            'limit' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetConsultationDoctorRequest(
            doctor_id: $request->input("doctor_id"),
            offset: $request->input("offset"),
            limit: $request->input("limit"),
        );

        $service = new GetConsultationDoctorService(
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

    public function completeConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CompleteConsultationRequest(
            id: $request->input("id"),
        );

        $service = new CompleteConsultationService(
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

    public function rejectConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new RejectConsultationRequest(
            id: $request->input("id"),
        );

        $service = new RejectConsultationService(
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

    public function cancelConsultation(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CancelConsultationRequest(
            id: $request->input("id"),
        );

        $service = new CancelConsultationService(
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

    public function createConsultationReview(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required',
            'is_public' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateConsultationReviewRequest(
            id: $request->input("id"),
            rating: $request->input("rating"),
            review: $request->input("review"),
            is_public: $request->boolean("is_public"),
        );

        $service = new CreateConsultationReviewService(
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

    public function getConsultationReview(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetConsultationReviewRequest(
            id: $request->input("id"),
        );

        $service = new GetConsultationReviewService(
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
