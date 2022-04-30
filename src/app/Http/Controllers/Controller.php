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
    public function successWithData(mixed $data): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'success',
                'data' => $data,
            ]
        );
    }

    /**
     * @param Exception $errors
     * @return JsonResponse
     */
    public function error(Exception $errors): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $errors->getCode(). ':' . $errors->getMessage(),
                'data' => [
                    'message' => $errors->getMessage(),
                    'code' => $errors->getCode(),
                ],
            ], 400
        );
    }

    /**
     * @param MessageBag $errors
     * @return JsonResponse
     */
    public function validationError(MessageBag $errors): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Validation Error',
                'data' => $errors,
            ], 400
        );
    }

    /**
     * @return JsonResponse
     */
    protected function success(): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => 'success',
            ]
        );
    }
}
