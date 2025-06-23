<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RouteLogger
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Log::channel('route')->info('route_access', [
            'time'   => now()->toDateTimeString(),
            'ip'     => $request->ip(),
            'method' => $request->method(),
            'uri'    => $request->path(),
            'status' => $response->status(),
            'user'   => optional($request->user())->id,
        ]);

        return $response;
    }
}
