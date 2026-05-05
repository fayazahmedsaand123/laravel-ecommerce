<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminDashboard
{
    public function handle(Request $request, Closure $next)
    {
        // Not logged in
        if (!session()->has('login_id')) {
            return redirect()->route('login')->with('fail', 'Please login first');
        }

        // Not admin
        if (session('role') !== 'admin') {
            return redirect()->route('record_product')->with('fail', 'Please logout first');
        }

        return $next($request);
    }
}
