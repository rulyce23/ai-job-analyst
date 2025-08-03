<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin email/username
        if (Auth::check() && 
            (Auth::user()->email === 'admin@example.com' || 
             Auth::user()->name === 'admin')) {
            return $next($request);
        }
        
        // Redirect to dashboard with error message if not admin
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk fitur ini.');
    }
}
