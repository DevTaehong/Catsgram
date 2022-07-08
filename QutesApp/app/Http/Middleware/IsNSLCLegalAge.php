<?php

namespace App\Http\Middleware;

use Closure;

class IsNSLCLegalAge
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
        $legalAge = 19;

        if(request('age')<$legalAge){
            abort(403, 'Access denied - Your\'e too young');
        }

        return $next($request);
    }
}
