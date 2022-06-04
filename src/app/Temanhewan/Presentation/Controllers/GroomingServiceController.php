<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceRequest;
use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceService;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroomingServiceController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    public function createGroomingService(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'grooming_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateGroomingServiceRequest(
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('grooming_id')
        );

        $service = new CreateGroomingServiceService(
            $this->userRepository,
            $this->groomingServiceRepository
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response);
    }
}
