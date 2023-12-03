<?php

use App\Enums\ResponseStatus;

if (!function_exists('jsonResponse')) {
    function jsonResponse(bool $success, string $message, ResponseStatus $status, array $data = null, int $statusCode = 200) : \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => $status,
            'success' => $success,
            'message' => $message,
        ];

        $response[$success ? 'data' : 'error'] = $data;

        return response()->json($response, $statusCode);
    }
}
