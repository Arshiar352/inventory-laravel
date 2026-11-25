@extends('layouts.guest')

@section('title', 'ورود')

@section('content')
    <h2 class="h4 mb-4 text-center">ورود به سیستم انبارداری</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="login" class="form-label">ایمیل، موبایل یا نام کاربری</label>
            <input id="login" type="text" name="login" class="form-control"
                value="{{ old('login') }}" required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">رمز عبور</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">ورود</button>
    </form>

    <hr class="my-4">

    <p class="mb-0 text-center">
        حساب کاربری ندارید؟
        <a href="{{ route('register.show') }}">ثبت نام</a>
    </p>
@endsection
