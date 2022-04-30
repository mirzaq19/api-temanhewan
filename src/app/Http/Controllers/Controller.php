<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    public function successWithData(mixed $data, int $status=200, string $message='success'): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status
        );
    }

    /**
     * @param Exception $errors
     * @return JsonResponse
     */
    public function error(Exception $errors, int $status=400): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $errors->getCode(). ':' . $errors->getMessage(),
                'data' => [
                    'message' => $errors->getMessage(),
                    'code' => $errors->getCode(),
                ],
            ], $status
        );
    }

    /**
     * @param MessageBag $errors
     * @return JsonResponse
     */
    public function validationError(MessageBag $errors, int $status=400): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Validation Error',
                'data' => $errors,
            ], $status
        );
    }

    /**
     * @return JsonResponse
     */
    protected function success(int $status=200, string $message='success'): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
            ], $status
        );
    }
}
