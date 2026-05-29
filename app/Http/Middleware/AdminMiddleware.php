<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        //not logged in
        if(!auth()->check()) {
            return redirect('/login');
        }
        // Not Admin
        $user = auth()->user(); //return user object
        if(!$user->is_admin) {
            abort(403, "Unauthorized");
        }
        // Block Admins
        if($user->status === 'blocked') {
            auth()->logout();
            return redirect('/login')->with('error', 'Account Blocked');
        }

        return $next($request);
    }
}
