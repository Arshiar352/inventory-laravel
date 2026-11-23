<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


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
}
