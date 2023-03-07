<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Brands;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        if (Auth::check()) {
            if (Auth::user()->current_brand) {
                // $brandData = Brands::findOrFail(Auth::user()->current_brand);
                // Session::put('brand_id', $brandData->id);
                // Session::put('brand_name', $brandData->name);
                // Session::put('brand_logo', $brandData->logo);
                // Session::put('brand_email', $brandData->email);
                // Session::put('brand_link', $brandData->link);
                // Session::put('brand_address', $brandData->address);
                // Session::put('brand_phone', $brandData->phone);
                // Session::put('invoice_starting_number', $brandData->invoice_starting_number);
                // Session::put('mail_host', $brandData->mail_host);
                // Session::put('mail_driver', $brandData->mail_driver);
                // Session::put('mail_user_name', $brandData->mail_user_name);
                // Session::put('mail_password', $brandData->mail_password);
                // Session::put('mail_encryption', $brandData->mail_encryption);
                // Session::put('mail_email_address', $brandData->mail_email_address);
                // Session::put('mail_name', $brandData->mail_name);
                // Session::put('mail_port', $brandData->mail_port);
            }
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
