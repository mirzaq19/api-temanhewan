<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderRequest;
use App\Temanhewan\Core\Application\Service\CreateGroomingOrder\CreateGroomingOrderService;
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
}
