<?php

if (!function_exists('jsonResponse')) {
    function jsonResponse($success, $message, $data = null, $statusCode = 200) {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        $response[$success ? 'data' : 'error'] = $data;

        return response()->json($response, $statusCode);
    }
}
