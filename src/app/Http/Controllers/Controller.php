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
     * @param int $status
     * @param string $message
     * @return JsonResponse
     */
    public function successWithData(mixed $data, string $message='success', int $status=200): JsonResponse
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
     * @param int $status
     * @param string $message
     * @return JsonResponse
     */
    protected function success(string $message='success', int $status=200): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
            ], $status
        );
    }

    /**
     * @param mixed $errors
     * @param int $status
     * @return JsonResponse
     */
    public function error(mixed $errors, int $status=400): JsonResponse
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
     * @param int $status
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
     * @param array $response
     * @return JsonResponse
     */
    public function customResponse(array $response): JsonResponse
    {
        return response()->json($response['response'], $response['status']);
    }
}
