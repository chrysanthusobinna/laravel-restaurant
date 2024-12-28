<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == "global_admin") {
            return $next($request);
        }

        // If user is not authorized, redirect or abort
        return redirect()->route('admin.index')->with('error', 'You do not have permission to access this page.');
    }
}
