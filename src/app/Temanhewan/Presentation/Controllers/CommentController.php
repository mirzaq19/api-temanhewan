<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentRequest;
use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentService;
use App\Temanhewan\Core\Domain\Repository\CommentRepository;
use App\Temanhewan\Core\Domain\Repository\ForumRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct(
        private DBManager $db_manager,
        private UserRepository $userRepository,
        private ForumRepository $forumRepository,
        private CommentRepository $commentRepository
    ){ }

    public function createComment(Request $request): JsonResponse
    {
        $rules = [
            'content' => 'required|string',
            'forum_id' => 'required',
            'comment_images.*' => 'image|max:1024'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new CreateCommentRequest(
            content: $request->input("content"),
            forum_id: $request->input("forum_id"),
            comment_images: $request->file("comment_images") ?: null,
        );

        $service = new CreateCommentService(
            $this->userRepository,
            $this->forumRepository,
            $this->commentRepository,
        );

        $this->db_manager->begin();

        try{
            $response = $service->execute($input);
            $this->db_manager->commit();
        }catch(Exception $e){
            $this->db_manager->rollback();
            return $this->error($e->getMessage(), $e->getCode());
        }

        return $this->successWithData($response);
    }
}
