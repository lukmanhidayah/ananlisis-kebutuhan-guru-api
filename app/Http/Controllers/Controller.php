<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * Format a JSON response using the project template.
     */
    protected function response(
        mixed $result = null,
        string $message = '',
        int $code = 200,
    ): JsonResponse {
        return response()->json([
            'meta' => [
                'code'    => $code,
                'message' => $message,
            ],
            'result' => $result,
        ], $code);
    }
}
