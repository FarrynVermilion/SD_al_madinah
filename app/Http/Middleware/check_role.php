<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class check_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role_submit): Response
    {
        $role_submits = explode('|', $role_submit);
        if (in_array(Auth::user()->role, $role_submits)) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized action.','your_permission'=>Auth::user()->role,'permission'=>$role_submits], 403);
    }
}
