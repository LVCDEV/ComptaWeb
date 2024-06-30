<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginFilterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function doLogin(LoginFilterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('app.index'));
        }
        return to_route('auth.login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout() : RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login');
    }
}
