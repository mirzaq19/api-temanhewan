<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UICreateUserRequest;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateUser\CreateUserRequest;
use App\Temanhewan\Core\Application\Service\CreateUser\CreateUserService;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository
    )
    { }

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function createUser(UICreateUserRequest $request): JsonResponse|string
    {
        $input = new CreateUserRequest(
            name: $request->input("name"),
            profile_image: $request->file("profile_image") ? $request->file("profile_image") : null,
            birthdate: $request->input("birthdate"),
            username: $request->input("username"),
            gender: $request->input("gender"),
            role: $request->input("role"),
            email: $request->input("email"),
            password: $request->input("password"),
            address: $request->input("address"),
            phone: $request->input("phone"),
        );

        $service = new CreateUserService(
            userRepository: $this->userRepository
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
