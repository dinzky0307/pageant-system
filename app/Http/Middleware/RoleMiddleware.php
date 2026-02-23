<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $role = auth()->user()->role;

        if (!$role || !in_array($role, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
