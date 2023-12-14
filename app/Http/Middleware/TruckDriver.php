<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TruckDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('admin')->user()->role_id != 3)
        {
            if(Auth::guard('admin')->user()->role_id == 6)
        {
            if(Auth::guard('admin')->user()->truck->id != $request->route()->parameter('truck_id'))
        {
            return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute(),['id'=>Auth::guard('admin')->user()->truck->id]);
        }
        }else
        {
            return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute());
        }
        }

        return $next($request);
    }
}
