<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request->user()->is_admin);
        // Check if the user's admin account has been validated
        if ($request->user()->is_admin != 'valid') {
            return redirect('home')->with('failure', 'You are not allowed to access this page');
        }

        return $next($request);
    }
}
