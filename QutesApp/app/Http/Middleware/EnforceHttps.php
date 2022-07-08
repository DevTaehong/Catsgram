<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

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
       if(App::environment('production') && !$request->secure()){
           return redirect()->secure($request->getRequestUri());
       }

        return $next($request);
    }
}
