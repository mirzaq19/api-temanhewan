<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceRequest;
use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceService;
use App\Temanhewan\Core\Application\Service\DeleteGroomingService\DeleteGroomingServiceRequest;
use App\Temanhewan\Core\Application\Service\DeleteGroomingService\DeleteGroomingServiceService;
use App\Temanhewan\Core\Application\Service\UpdateGroomingService\UpdateGroomingServiceRequest;
use App\Temanhewan\Core\Application\Service\UpdateGroomingService\UpdateGroomingServiceService;
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

    public function updateGroomingService(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return $this->validationError($validator->errors());

        $input = new UpdateGroomingServiceRequest(
            $request->input('id'),
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
        );

        $service = new UpdateGroomingServiceService(
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

    public function deleteGroomingService(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return $this->validationError($validator->errors());

        $input = new DeleteGroomingServiceRequest(
            $request->input('id'),
        );

        $service = new DeleteGroomingServiceService(
            $this->userRepository,
            $this->groomingServiceRepository
        );

        $this->db_manager->begin();

        try {
            $service->execute($input);
            $this->db_manager->commit();
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->success();
    }
}
