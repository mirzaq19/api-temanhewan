<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateForum\CreateForumRequest;
use App\Temanhewan\Core\Application\Service\CreateForum\CreateForumService;
use App\Temanhewan\Core\Application\Service\GetForum\GetForumRequest;
use App\Temanhewan\Core\Application\Service\GetForum\GetForumService;
use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumRequest;
use App\Temanhewan\Core\Application\Service\GetMyForum\GetMyForumService;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private ForumRepository $forumRepository
    ){ }

    public function createForum(Request $request): JsonResponse
    {
        $rules = [
            'title' => 'required|string|max:150',
            'subtitle' => 'required|string',
            'content' => 'required|string',
            'forum_images.*' => 'image|max:1024'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateForumRequest(
            title: $request->input("title"),
            subtitle: $request->input("subtitle"),
            content: $request->input("content"),
            forum_images: $request->file("forum_images") ?: null,
        );

        $service = new CreateForumService(
            $this->userRepository,
            $this->forumRepository,
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

    public function getForum(Request $request): JsonResponse
    {
        $rules = [
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetForumRequest(
            id: $request->input("id")
        );

        $service = new GetForumService(
            $this->forumRepository,
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

    public function getMyForum(Request $request): JsonResponse
    {
        $rules = [
            'offset' => 'required|integer',
            'limit' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetMyForumRequest(
            offset: $request->input("offset"),
            limit: $request->input("limit"),
        );

        $service = new GetMyForumService($this->forumRepository);

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
