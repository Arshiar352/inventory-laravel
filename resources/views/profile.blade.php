<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل کاربر</title>
</head>

<body>

    <h1>پروفایل من</h1>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
    @endif

    @if ($user->profile_picture)
    <img
        src="{{ asset('storage/' . $user->profile_picture) }}"
        width="120"
        alt="عکس پروفایل">
    @endif

    <form action="{{ route('profile.update') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div>
            <label>نام کاربری</label>
            <input
                type="text"
                name="username"
                value="{{ old('username', $user->username) }}"
                required>
        </div>

        <div>
            <label>ایمیل</label>
            <input type="email" value="{{ $user->email }}" disabled>
        </div>

        <div>
            <label>موبایل</label>
            <input type="text" value="{{ $user->mobile }}" disabled>
        </div>

        <div>
            <label>تاریخ تولد</label>
            <input
                type="text"
                name="birth_date"
                value="{{ old('birth_date', $birthDate) }}"
                placeholder="1400/05/20"
                required>
        </div>
        <div>
            <label>سن:</label>
            <span>{{ $age }} سال</span>
        </div>

        <div>
            <label>عکس پروفایل</label>
            <input
                type="file"
                name="profile_picture"
                accept="image/*">
        </div>

        <button type="submit">ذخیره تغییرات</button>
    </form>

    <a href="{{ route('home') }}">بازگشت به خانه</a>

</body>

</html>