<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateForum\CreateForumRequest;
use App\Temanhewan\Core\Application\Service\CreateForum\CreateForumService;
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
            $service->execute($input);
            $this->db_manager->commit();
        }catch (Exception $e){
            $this->db_manager->rollback();
            return $this->error($e);
        }

        return $this->success();
    }
}
