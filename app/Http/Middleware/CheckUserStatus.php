<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()) {
            $user = auth()->user();
            if($user->status === 'active') {
                return $next($request);
            } else {
                auth()->logout();
                redirect('/login')->with('error', 'Your account has been Blocked!');
            }
        }
        return $next($request);
    }
}
