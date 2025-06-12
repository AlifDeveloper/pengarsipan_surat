<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as RedirectIfAuthenticatedMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends RedirectIfAuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        if(Auth::guard('petugas')->check()){
            return redirect(route('klasifikasi-arsip.index'));
        } else if(Auth::guard('kades')->check()) {
            return redirect(route('klasifikasi-arsip.index'));
        }

        return $next($request);
    }
}
