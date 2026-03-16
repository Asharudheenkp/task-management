<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ExecutionTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (defined('LARAVEL_START')) {
            $time = round((microtime(true) - LARAVEL_START) * 1000, 2);
            Log::info("Request [{$request->path()}] took {$time}ms");
        }
        return $next($request);
    }
}
