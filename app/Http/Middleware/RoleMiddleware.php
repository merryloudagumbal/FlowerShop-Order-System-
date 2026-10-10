<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles): mixed
    {
        if (! Auth::check()) {
            abort(403, 'You do not have permission to access this page.');
        }

        // Support multiple roles separated by | or ,
        $allowed = preg_split('/[|,]/', $roles);
        $userRole = Auth::user()->role;

        if (! in_array($userRole, $allowed, true)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
