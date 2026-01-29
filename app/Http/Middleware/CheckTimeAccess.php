<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckTimeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = now();
        $start = Carbon::parse('07:00:00');
        $end = Carbon::parse('17:00:00');
        if ($now->between($start, $end)) {
        else{
            return response()->json([
                'message' => 'Access denied',
                'time' => $now->format('H:i:s')
            ], 403);
            return $next($request);
        }
    }
}
