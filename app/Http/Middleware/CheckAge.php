<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = session('age');
        if ($age < 18 || !is_numeric($age)) {
            return response()->json([
                'message' => 'Access denied. You must be at least 18 years old.',
                'age' => $age,
            ], 403);
        }
        return $next($request);
    }
}