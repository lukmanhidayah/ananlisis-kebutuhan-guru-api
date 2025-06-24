<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(App\Http\Middleware\ForceJsonResponse::class);
        $middleware->append(App\Http\Middleware\ConvertCamelCase::class);
        $middleware->append(App\Http\Middleware\RouteLogger::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                if ($request->expectsJson() || $request->is('api/*')) {
                    return response()->json([
                        'meta' => [
                            'code' => 404,
                            'message' => 'Not Found',
                        ],
                        'result' => null,
                    ], 404);
                }
            }

            if ($e instanceof AuthenticationException) {
                if ($request->expectsJson() || $request->is('api/*')) {
                    return response()->json([
                        'meta' => [
                            'code' => 401,
                            'message' => 'Unauthorized',
                        ],
                        'result' => null,
                    ], 401);
                }
            }

            if ($e instanceof ValidationException) {
                $errors = [];
                foreach ($e->errors() as $key => $value) {
                    $errors = $value;
                }

                return response()->json([
                    'meta' => [
                        'code' => $e->status,
                        'message' => $errors[0] ?? 'Validation Error',
                    ],
                    'result' => null,
                ], $e->status);
            }
        });
    })->create();
