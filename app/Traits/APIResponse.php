<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\Types\Collection;

trait APIResponse
{
    /**
     * Internal Server Error / Custom Validation Response
     *
     * @param array $message
     * @return JsonResponse
     */
    public function exceptionResponse(array $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => 'failed',
            'data' => null
        ], 500);
    }

    /**
     * Invalid Request Response / Custom Validation Response
     *
     * @param array $message
     * @param null $data
     * @return JsonResponse
     */
    public function invalidResponse(array $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => $message,
            'data' => $data,
        ], 422);
    }

    /**
     * Internal Server Error / Custom Validation Response
     *
     * @param array $message
     * @param null $data
     * @return JsonResponse
     */

    public function successResponse(array $message, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    /**
     * Generic response
     *
     * @param array $message
     * @param string $status
     * @param int $code
     * @param null $data
     * @return JsonResponse
     */
    public function response(array $message, string $status = 'success', int $code = 200, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ], $code);
    }
}
