<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
    public function errors(Exception $errors): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'error '. $errors->getCode() . ':' . $errors->getMessage(),
                'data' => [
                    'message' => $errors->getMessage(),
                    'code' => $errors->getCode(),
                ],
            ]
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
