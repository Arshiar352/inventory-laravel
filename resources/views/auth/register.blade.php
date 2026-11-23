<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
</head>

<body>

    <h1>ثبت نام در سیستم انبارداری</h1>

    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('register.create') }}" method="POST">
        @csrf

        <div>
            <label>نام کاربری</label>
            <input
                type="text"
                name="username"
                value="{{ old('username') }}"
                required>
        </div>

        <div>
            <label>ایمیل</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required>
        </div>

        <div>
            <label>شماره موبایل</label>
            <input
                type="tel"
                name="mobile"
                value="{{ old('mobile') }}"
                required>
        </div>

        <div>
            <label>تاریخ تولد</label>
            <input
                type="text"
                name="birth_date"
                placeholder="مثلاً 1380/05/20"
                value="{{ old('birth_date') }}"
                required>
        </div>

        <div>
            <label>رمز عبور</label>
            <input
                type="password"
                name="password"
                required>
        </div>

        <div>
            <label>تکرار رمز عبور</label>
            <input
                type="password"
                name="password_confirmation"
                required>
        </div>

        <button type="submit">ثبت نام</button>
    </form>

    <p>
        قبلاً ثبت نام کرده‌اید؟
        <a href="{{ route('login') }}">ورود</a>
    </p>

</body>

</html>