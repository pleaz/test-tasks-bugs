<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $log = [
            'path' => $request->path(),
            'method' => $request->getMethod(),
            'request' => json_encode($request->all()),
        ];

        Log::create($log); // TODO move to jobs

        return $next($request);
    }
}
