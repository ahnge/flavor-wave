<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View | RedirectResponse
    {
        if(Auth::guard('web')->check()){
            return redirect()->route(Auth::guard('web')->user()->getRedirectRoute());
        }
        elseif(Auth::guard('admin')->check()){

        if(Auth::guard('admin')->user()->role_id == 6)
        {
            return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute(),['id'=>Auth::guard('admin')->user()->truck()->id]);
        }

            return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute());
        }


        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate('admin');

        $request->session()->regenerate();


        if(Auth::guard('admin')->user()->role_id == 6)
        {
            return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute(),['truck_id'=>Auth::guard('admin')->user()->truck]);
        }

        return redirect()->route(Auth::guard('admin')->user()->getRedirectRoute());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
         Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
