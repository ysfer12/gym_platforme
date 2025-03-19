<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if email is verified
        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }
        
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }
}