<?php

namespace App\Http\Middleware;

use Closure;

class InstalledStateMiddleware
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
        if ( ns()->installed() ) {
            return $next($request);
        }
        
        return redirect()->route( 'setup' );
    }
}
