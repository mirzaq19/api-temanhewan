<?php

namespace App\Temanhewan\Presentation\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use App\Temanhewan\Core\Application\Service\CreateUser\CreateUserRequest;
use App\Temanhewan\Core\Application\Service\CreateUser\CreateUserService;

class UserController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository
    )
    { }

    /**
     * @throws Exception
     */
    public function createUser(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'profile_image' => 'sometimes|image|max:1024',
            'birthdate' => 'required|date',
            'username' => 'required|unique:users,username',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

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

        $service = new CreateUserService($this->userRepository);

        $this->db_manager->begin();

        try {
            $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->success();
    }
}
