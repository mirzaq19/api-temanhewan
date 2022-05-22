<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Temanhewan\Core\Application\Service\UpdateUser\UpdateUserRequest;
use App\Temanhewan\Core\Application\Service\UpdateUser\UpdateUserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Domain\Repository\UserRepository;


class UserController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository
    ){ }

    public function update(Request $request): jsonResponse
    {
        $rules = [
            'name' => 'required',
            'profile_image' => 'sometimes|image|max:1024',
            'birthdate' => 'required|date',
            'password' => 'sometimes|string|min:6|confirmed',
            'address' => 'required',
            'phone' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new UpdateUserRequest(
            name: $request->input("name"),
            profile_image: $request->file("profile_image") ? $request->file("profile_image") : null,
            birthdate: $request->input("birthdate"),
            password: $request->input("password"),
            address: $request->input("address"),
            phone: $request->input("phone"),
        );

        $service = new UpdateUserService($this->userRepository);

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
