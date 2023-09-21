<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next,string $userRole): Response
    {
        if (auth()->user()->getRoleNameAttribute() !== $userRole) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
