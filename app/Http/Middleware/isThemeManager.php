<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isThemeManager
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
        $UserRoles = \DB::table('roles')->join('role_user','role_id', '=', 'roles.id')->where('user_id', '=', Auth::user()->id)->pluck('name');

        $isThemeManager = false;
        foreach($UserRoles as $role)
        {
            if($role == 'Theme Manager')
            {
                $isThemeManager = true;
            }
        }

        if( ! $isThemeManager )
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back()->with('error', 'Denied - You do not have permissions to access Theme Management');
            }
        }
        return $next($request);
    }
}
