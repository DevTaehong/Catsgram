<?php

namespace App\Http\Middleware;

use Closure;

class EnforceHttps
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
        //check to see if the incoming request is coming over http or https
       if(!$request->secure()){
           return redirect()->secure($request->getUriForPath());
       }

        return $next($request);
    }
}
