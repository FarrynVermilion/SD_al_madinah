<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class check_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role_submit): Response
    {
        if(Auth()->user()->role==$role_submit){
            return $next($request);
        }
        return response()->json(['Anda tidak di izinkan untuk mengakses ini']);
    }
}
