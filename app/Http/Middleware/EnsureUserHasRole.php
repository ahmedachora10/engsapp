<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // dd(User::find($request->user()->id)->hasRole($role));
        if (!$request->user()->ensureUserHasRole($role)) {
            // Redirect...
            return redirect()->route('home');
        }
        // $user = new User();
        // $user->hasRole()
        // dd($role);
        return $next($request);
    }
}
