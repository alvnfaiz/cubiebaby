<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, $guard = null)
   {

       if (Auth::guard($guard)->guest()) {
           if ($request->ajax() || $request->wantsJson()) {
               return response('Unauthorized.', 401);
           } else {
               return redirect()->guest('/login'); // I just found this out and updated this line to redirect to the correct location.
           }
       }

       return $next($request);
   }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
