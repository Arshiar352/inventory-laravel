<form action="{{ route('login.submit') }}" method="POST">
    @csrf

    <input
        type="text"
        name="login"
        placeholder="ایمیل، موبایل یا نام کاربری"
        value="{{ old('login') }}">

    <input
        type="password"
        name="password"
        placeholder="رمز عبور">

    <button type="submit">ورود</button>
</form>