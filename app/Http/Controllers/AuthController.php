<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validated = $request->validate([
            'username' => 'unique:users,username|required',
            'email' => 'required|unique:users,email|email',
            'mobile' => 'required|digits:11|unique:users,mobile',
            'birth_date' => 'required|date',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create($validated);

        return redirect()
            ->route('login')
            ->with('success', 'ثبت‌نام با موفقیت انجام شد.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');


        if (str_contains($login, '@')) {
            $field = 'email';
        } elseif (is_numeric($login)) {
            $field = 'mobile';
        } else {
            $field = 'username';
        }

        $isLoggedIn = Auth::attempt([
            $field => $login,
            'password' => $password,
        ]);

        if ($isLoggedIn) {
            $request->session()->regenerate();

            return redirect()
                ->route('home')
                ->with('success', 'خوش آمدید.');
        } else {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'ایمیل، شماره موبایل، نام کاربری یا رمز عبور اشتباه است.',
                ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }

    public function showRegister()
    {

        return view('auth.register');
    }

    public function showLogin()
    {

        return view('auth.login');
    }
}
