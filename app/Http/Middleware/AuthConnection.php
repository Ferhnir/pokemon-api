<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $headerKey = $request->header('X-SUPER-SECRET-KEY');
        $validKey  = config('app.super_secret_key');

        if (! $headerKey) {
            return response()->json([
                'message' => 'Missing X-SUPER-SECRET-KEY header'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($headerKey !== $validKey) {
            return response()->json([
                'message' => 'Invalid API key'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
