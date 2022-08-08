<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Kepsek {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->role == 4) {
            return redirect()->back()->with('fail', "Anda tidak memiliki akses ke halaman tersebut!");
        }

        return $next($request);
    }
}