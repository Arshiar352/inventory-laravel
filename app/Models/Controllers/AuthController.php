<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:11|unique:users,mobile',
            'birth_date' => 'required|jdate:Y/m/d',
            'password' => 'required|confirmed|min:8',
        ]);

        $validated['birth_date'] = Verta::parse(
            $validated['birth_date']
        )->toCarbon()->format('Y-m-d');

        User::create($validated);

        return redirect()
            ->route('login')
            ->with('success', 'ثبت‌نام با موفقیت انجام شد.');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $validated['login'];
        $password = $validated['password'];

        if (str_contains($login, '@')) {
            $field = 'email';
        } elseif (ctype_digit($login) && strlen($login) === 11) {
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
        }

        return back()
            ->withErrors([
                'login' => 'اطلاعات ورود اشتباه است.',
            ])
            ->onlyInput('login');
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
