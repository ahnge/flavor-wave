<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\Region;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View | RedirectResponse
    {
        if(Auth::guard('admin')->check()){
            return redirect(Auth::guard('admin')->user()->getRedirectRoute());
        }
        elseif(Auth::guard('web')->check()){
            return redirect(Auth::guard('web')->user()->getRedirectRoute());
        }

        return view('auth.register',['regions'=>Region::all()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Distributor::class],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Distributor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'region_code' => $request->region,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('web')->login($user);

        return redirect('/');
    }
}
