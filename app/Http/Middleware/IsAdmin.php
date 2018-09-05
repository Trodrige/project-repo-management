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
        // Check if the user's admin account has been validated
    if ($request->user()->is_admin != 'valid' /* && $request->user()->role != 'admin' */) {
            return redirect('home')->with('failure', 'You are not allowed to access this page');
        }

        return $next($request);
        */
        //if ( Auth::check() && Auth::user()->isAdmin() ){
        if(auth()->user()->isAdmin()){
            return $next($request);
        }
        return redirect ('home');
    }

}
