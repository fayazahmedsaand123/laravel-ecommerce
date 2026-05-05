<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!session()->has('login_id')) {
            return redirect()->route('login')->with('fail','Please login first.');
        }

        if(session('role') !== 'admin') {
            return redirect()->route('record_product')->with('fail','Access denied. Admins only.');
        }
        return $next($request);
    }
}
