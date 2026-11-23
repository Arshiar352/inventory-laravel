<h1>به سیستم انبارداری خوش آمدید</h1>

<p>شما با موفقیت وارد سیستم شده‌اید.</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">خروج</button>
</form>