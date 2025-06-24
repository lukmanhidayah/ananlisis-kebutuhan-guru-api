<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConvertCamelCase
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isJson()) {
            $request->replace($this->snakeKeys($request->all()));
        }

        return $next($request);
    }

    private function snakeKeys(array $data): array
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
