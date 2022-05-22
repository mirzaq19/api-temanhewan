<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Temanhewan\Core\Application\Service\DeletePet\DeletePetRequest;
use App\Temanhewan\Core\Application\Service\DeletePet\DeletePetService;
use App\Temanhewan\Core\Application\Service\GetPet\GetPetRequest;
use App\Temanhewan\Core\Application\Service\GetPet\GetPetService;
use App\Temanhewan\Core\Application\Service\ListPet\ListPetRequest;
use App\Temanhewan\Core\Application\Service\ListPet\ListPetService;
use App\Temanhewan\Core\Application\Service\UpdatePet\UpdatePetRequest;
use App\Temanhewan\Core\Application\Service\UpdatePet\UpdatePetService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreatePet\CreatePetRequest;
use App\Temanhewan\Core\Application\Service\CreatePet\CreatePetService;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class PetController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private PetRepository $petRepository
    ){}

    public function createPet(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'profile_image' => 'sometimes|image|max:1024',
            'description' => 'sometimes|max:255',
            'race' => 'required',
            'gender' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreatePetRequest(
            name: $request->input("name"),
            profile_image: $request->file("profile_image") ?: null,
            description: $request->input("description") ?: null,
            race: $request->input("race"),
            gender: $request->input("gender"),
        );

        $service = new CreatePetService(
            userRepository: $this->userRepository,
            petRepository: $this->petRepository
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response,'Pet Added Successfully', 201);
    }

    public function getPet(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetPetRequest(
            petId: $request->input("id"),
        );

        $service = new GetPetService(
            petRepository: $this->petRepository
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

    public function updatePet(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'profile_image' => 'sometimes|image|max:1024',
            'description' => 'sometimes|max:255',
            'race' => 'required',
            'gender' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new UpdatePetRequest(
            petId: $request->input("id"),
            name: $request->input("name"),
            profile_image: $request->file("profile_image") ?: null,
            description: $request->input("description") ?: null,
            race: $request->input("race"),
            gender: $request->input("gender"),
        );

        $service = new UpdatePetService(
            userRepository: $this->userRepository,
            petRepository: $this->petRepository
        );

        $this->db_manager->begin();

        try {
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->successWithData($response,'Pet successfully updated');
    }

    public function listPet(Request $request): JsonResponse
    {
        $rules = [
            'offset' => 'required',
            'limit' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new ListPetRequest(
            offset: $request->input("offset"),
            limit: $request->input("limit"),
        );

        $service = new ListPetService(
            petRepository: $this->petRepository
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

    public function deletePet(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return $this->validationError($validator->errors());

        $input = new DeletePetRequest(
            petId: $request->input("id"),
        );

        $service = new DeletePetService(
            petRepository: $this->petRepository
        );

        $this->db_manager->begin();

        try {
            $service->execute($input);
            $this->db_manager->commit();
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->success("Pet successfully deleted");
    }

}
