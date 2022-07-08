<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        // Source Code: https://laracasts.com/discuss/channels/general-discussion/create-middleware-to-auth-admin-users?page=0
        $UserRoles = \DB::table('roles')->join('role_user','role_id', '=', 'roles.id')->where('user_id', '=', Auth::user()->id)->pluck('name');

        $isAdmin = false;
        foreach($UserRoles as $role)
        {
            if($role == 'User Administrator' or $role == 'Moderator' or $role == 'Theme Manager')
            {
                $isAdmin = true;
            }
        }

        if( ! $isAdmin )
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back()->with('error', 'Denied - You do not have permissions to access User Management');
            }
        }
        return $next($request);
    }
}
