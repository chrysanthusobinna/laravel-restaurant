<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleCustomer
{

    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == "customer") {
            return $next($request);
        }

        // If user is not authorized, redirect or abort
        return redirect()->route('customer.account')->with('error', 'You do not have permission to access this page.');
    }
}
