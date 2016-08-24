<?php

namespace Jfreites\Luna\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
//use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Sentinel::getUser();

        // Has the user a Role as Admin? => permissions : { admin: true }
        //  - no, he has not. Redirecto to login.

        if (!$user) {
            return redirect('admin/login');
        }

        /*if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                #return response(trans('luna::cms.unauthorized'), 401);
                die('No puedes pasar 401');
            } else {
                return redirect()->guest('admin/login');
            }
        }*/
        return $next($request);
    }
}
