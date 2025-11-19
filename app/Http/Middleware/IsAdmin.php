<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * 
     * This middleware ensures that only users with 'admin' role can access protected routes.
     * Redirects non-admin users to the shop homepage with an error message.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('shop.index')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
