<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $isLoggedIn = $request->session()->get('is_admin_logged_in', false);

        if (!$isLoggedIn) {
            // Redirect to login page if not authenticated
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
