<?php

namespace App\Http\Controllers;

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
                'data' => $data,
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
            ]
        );
    }
}
