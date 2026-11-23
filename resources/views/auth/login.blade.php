<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
</head>

<body>

    <h1>ورود به سیستم انبارداری</h1>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">

        @csrf

        <div>
            <label>ایمیل، موبایل یا نام کاربری</label>

            <input
                type="text"
                name="login"
                value="{{ old('login') }}"
                required>
        </div>

        <div>
            <label>رمز عبور</label>

            <input
                type="password"
                name="password"
                required>
        </div>

        <button type="submit">ورود</button>

    </form>

    <p>
        حساب کاربری ندارید؟
        <a href="{{ route('register.show') }}">ثبت نام</a>
    </p>

</body>

</html>