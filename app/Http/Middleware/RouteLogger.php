<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RouteLogger
{
    public function handle($request, Closure $next)
    {
        $requestId = $request->header('X-Request-Id', (string) Str::uuid());
        $request->headers->set('X-Request-Id', $requestId);

        $response = $next($request);
        $response->headers->set('X-Request-Id', $requestId);

        Log::channel('route')->info('route_access', [
            'requestId' => $requestId,
            'time'      => now()->toDateTimeString(),
            'ip'        => $request->ip(),
            'method'    => $request->method(),
            'uri'       => $request->path(),
            'status'    => $response->status(),
            'user'      => optional($request->user())->id,
            'request'   => $request->all(),
            'response'  => $this->parseResponse($response),
        ]);

        return $response;
    }

    private function parseResponse($response)
    {
        $content = $response->getContent();
        $json = json_decode($content, true);

        return $json ?? $content;
    }
}
