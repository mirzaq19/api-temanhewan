<?php

namespace App\Temanhewan\Presentation\Controllers;

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
            $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->success('Pet Added Successfully', 201);
    }
}
