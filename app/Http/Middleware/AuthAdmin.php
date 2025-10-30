<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user is an admin
            if (Auth::user()->utype === 'ADM') {
                return $next($request);
            } else {
                // Not admin: redirect to login
                session()->flush();
                return redirect()->route('login');
            }
        }
        else {
        // Not logged in: redirect to login
        return redirect()->route('login');
        }
    }
}
