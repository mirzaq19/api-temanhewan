<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CancelGroomingOrder\CancelGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\CancelGroomingOrder\CancelGroomingOrderService;
use App\Temanhewan\Core\Application\Service\CompleteGroomingOrder\CompleteGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\CompleteGroomingOrder\CompleteGroomingOrderService;
use App\Temanhewan\Core\Application\Service\ConfirmGroomingOrder\ConfirmGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\ConfirmGroomingOrder\ConfirmGroomingOrderService;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderService;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview\CreateGroomingOrderReviewRequest;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrderReview\CreateGroomingOrderReviewService;
use App\Temanhewan\Core\Application\Service\DeliverGroomingOrder\DeliverGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\DeliverGroomingOrder\DeliverGroomingOrderService;
use App\Temanhewan\Core\Application\Service\GetGroomingOrder\GetGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\GetGroomingOrder\GetGroomingOrderService;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderCustomer\GetGroomingOrderCustomerRequest;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderCustomer\GetGroomingOrderCustomerService;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderGrooming\GetGroomingOrderGroomingRequest;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderGrooming\GetGroomingOrderGroomingService;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderReview\GetGroomingOrderReviewRequest;
use App\Temanhewan\Core\Application\Service\GetGroomingOrderReview\GetGroomingOrderReviewService;
use App\Temanhewan\Core\Application\Service\PaidGroomingOrder\PaidGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\PaidGroomingOrder\PaidGroomingOrderService;
use App\Temanhewan\Core\Application\Service\RejectGroomingOrder\RejectGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\RejectGroomingOrder\RejectGroomingOrderService;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroomingOrderController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private PetRepository $petRepository,
        private GroomingServiceRepository $groomingServiceRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    public function createGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'address' => 'required',
            'grooming_service_id' => 'required',
            'pet_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateGroomingOrderRequest(
            address: $request->input('address'),
            grooming_service_id: $request->input('grooming_service_id'),
            pet_id: $request->input('pet_id'),
        );

        $service = new CreateGroomingOrderService(
            $this->userRepository,
            $this->petRepository,
            $this->groomingServiceRepository,
            $this->groomingOrderRepository
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

    public function getGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetGroomingOrderRequest(
            id: $request->input('id')
        );

        $service = new GetGroomingOrderService(
            $this->groomingOrderRepository
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

    public function getGroomingOrderCustomer(Request $request): JsonResponse
    {
        $rules = [
            'customer_id' => 'required',
            'offset' => 'required',
            'limit' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetGroomingOrderCustomerRequest(
            customer_id: $request->input('customer_id'),
            offset: $request->input('offset'),
            limit: $request->input('limit')
        );

        $service = new GetGroomingOrderCustomerService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function getGroomingOrderGrooming(Request $request): JsonResponse
    {
        $rules = [
            'grooming_id' => 'required',
            'offset' => 'required',
            'limit' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetGroomingOrderGroomingRequest(
            grooming_id: $request->input('grooming_id'),
            offset: $request->input('offset'),
            limit: $request->input('limit')
        );

        $service = new GetGroomingOrderGroomingService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function paidGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new PaidGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new PaidGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function cancelGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CancelGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new CancelGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function rejectGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new RejectGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new RejectGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function confirmGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new ConfirmGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new ConfirmGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function deliverGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new DeliverGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new DeliverGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function completeGroomingOrder(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CompleteGroomingOrderRequest(
            id: $request->input('id'),
        );

        $service = new CompleteGroomingOrderService(
            $this->userRepository,
            $this->groomingOrderRepository
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

    public function createGroomingOrderReview(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required',
            'is_public' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateGroomingOrderReviewRequest(
            id: $request->input("id"),
            rating: $request->input("rating"),
            review: $request->input("review"),
            is_public: $request->boolean("is_public"),
        );

        $service = new CreateGroomingOrderReviewService(
            $this->userRepository,
            $this->groomingOrderRepository,
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

    public function getGroomingOrderReview(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetGroomingOrderReviewRequest(
            id: $request->input("id"),
        );

        $service = new GetGroomingOrderReviewService(
            $this->groomingOrderRepository,
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
