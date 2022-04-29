<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UICreatePetRequest;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreatePet\CreatePetRequest;
use App\Temanhewan\Core\Application\Service\CreatePet\CreatePetService;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class PetController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private PetRepository $petRepository
    ){}

    public function createPet(UICreatePetRequest $request): JsonResponse
    {
        $input = new CreatePetRequest(
            name: $request->input("name"),
            profile_image: $request->file("profile_image") ? $request->file("profile_image") : null,
            description: $request->input("description") ? $request->input("description") : '-',
            birthdate: $request->input("birthdate"),
            race: $request->input("race"),
            gender: $request->input("gender"),
            id_user: $request->input('id_user')
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
            return $this->errors($e);
        }

        return $this->success();
    }
}
