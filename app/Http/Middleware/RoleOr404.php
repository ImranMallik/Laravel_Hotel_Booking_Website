<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleOr404
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            throw new NotFoundHttpException(); // User is not authenticated
        }

        // Check if the user has the required role
        if (!Auth::user()->hasAnyRole($roles)) {
            throw new NotFoundHttpException(); // Role not matched
        }

        return $next($request);
    }
}
