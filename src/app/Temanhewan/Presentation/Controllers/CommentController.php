<?php

namespace App\Temanhewan\Presentation\Controllers;

use App\Shared\Service\DBManager;
use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentRequest;
use App\Temanhewan\Core\Application\Service\CreateComment\CreateCommentService;
use App\Temanhewan\Core\Application\Service\DeleteComment\DeleteCommentRequest;
use App\Temanhewan\Core\Application\Service\DeleteComment\DeleteCommentService;
use App\Temanhewan\Core\Application\Service\GetComment\GetCommentRequest;
use App\Temanhewan\Core\Application\Service\GetComment\GetCommentService;
use App\Temanhewan\Core\Application\Service\GetForumComments\GetForumCommentsRequest;
use App\Temanhewan\Core\Application\Service\GetForumComments\GetForumCommentsService;
use App\Temanhewan\Core\Application\Service\UpdateComment\UpdateCommentRequest;
use App\Temanhewan\Core\Application\Service\UpdateComment\UpdateCommentService;
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

    public function getComment(Request $request): JsonResponse
    {
        $rules = [
            'comment_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetCommentRequest(
            comment_id: $request->input("comment_id")
        );

        $service = new GetCommentService(
            $this->userRepository,
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

    public function getForumComments(Request $request): JsonResponse
    {
        $rules = [
            'forum_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new GetForumCommentsRequest(
            forum_id: $request->input("forum_id")
        );

        $service = new GetForumCommentsService(
            $this->userRepository,
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

    public function updateComment(Request $request): JsonResponse
    {
        $rules = [
            'comment_id' => 'required',
            'content' => 'required|string',
            'comment_images.*' => 'image|max:1024'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new UpdateCommentRequest(
            comment_id: $request->input("comment_id"),
            content: $request->input("content"),
            comment_images: $request->file("comment_images") ?: null,
        );

        $service = new UpdateCommentService(
            $this->userRepository,
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
    public function deleteComment(Request $request): JsonResponse
    {
        $rules = [
            'comment_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $input = new DeleteCommentRequest(
            comment_id: $request->input("comment_id")
        );

        $service = new DeleteCommentService(
            $this->commentRepository,
        );

        $this->db_manager->begin();

        try{
            $service->execute($input);
            $this->db_manager->commit();
        }catch(Exception $e){
            $this->db_manager->rollback();
            return $this->error($e->getMessage(), $e->getCode());
        }

        return $this->success();
    }
}
