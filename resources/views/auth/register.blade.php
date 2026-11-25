@extends('layouts.guest')

@section('title', 'ثبت نام')

@section('content')
    <h2 class="h4 mb-4 text-center">ثبت نام در سیستم انبارداری</h2>

    <form action="{{ route('register.create') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">نام کاربری</label>
            <input id="username" type="text" name="username" class="form-control"
                value="{{ old('username') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">ایمیل</label>
            <input id="email" type="email" name="email" class="form-control"
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">شماره موبایل</label>
            <input id="mobile" type="tel" name="mobile" class="form-control"
                value="{{ old('mobile') }}" required>
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">تاریخ تولد</label>
            <input id="birth_date" type="text" name="birth_date" class="form-control"
                placeholder="مثلاً 1380/05/20" value="{{ old('birth_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">رمز عبور</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">تکرار رمز عبور</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">ثبت نام</button>
    </form>

    <hr class="my-4">

    <p class="mb-0 text-center">
        قبلاً ثبت نام کرده اید؟
        <a href="{{ route('login') }}">ورود</a>
    </p>
@endsection
