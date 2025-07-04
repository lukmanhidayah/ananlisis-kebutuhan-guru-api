<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'meta' => [
                        'code' => 404,
                        'message' => 'Not Found',
                    ],
                    'data' => null,
                ], 404);
            }
        }

        if ($e instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'meta' => [
                        'code' => 401,
                        'message' => 'Unauthorized',
                    ],
                    'data' => null,
                ], 401);
            }
        }

        if ($e instanceof ValidationException) {
            return $this->invalidJson($request, $e);
        }
        
        return parent::render($request, $e);
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'meta' => [
                'code' => $exception->status,
                'message' => 'Validation Error',
            ],
            'errors' => $this->camelKeys($exception->errors()),
        ], $exception->status);
    }

    private function camelKeys(array $data): array
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
}
