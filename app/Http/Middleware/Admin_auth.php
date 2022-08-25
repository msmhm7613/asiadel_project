<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Admin_auth
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
        if(Auth::check() === false)
            return redirect('admin/login');

        $role_id = Auth::user()->role_id;

        // check user type role

        if ($role_id == 2)
            return redirect('/');
        else {
            $route_name = $request->route()->getName();
            foreach (session('access_route') as $item) {
                if ($item[0] == $route_name)
                    return $next($request);
            }
            return redirect('admin/dashboard')->with(['status' => 0,'msg' => 'درخواست دسترسی غیر مجاز']);
        }
    }
}
