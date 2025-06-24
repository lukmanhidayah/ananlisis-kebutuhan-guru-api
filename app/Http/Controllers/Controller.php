<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

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
            'data' => $result,
        ], $code);
    }

    protected function camelKeys(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $key = Str::camel($key);
            if (is_array($value)) {
                $value = $this->camelKeys($value);
            }
            $result[$key] = $value;
        }

        return $result;
    }

    protected function snakeKeys(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $key = Str::snake($key);
            if (is_array($value)) {
                $value = $this->snakeKeys($value);
            }
            $result[$key] = $value;
        }

        return $result;
    }
}
