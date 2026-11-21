<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ثبت محصول</title>
</head>

<body>

    <h1>ثبت محصول جدید</h1>

    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{ route('products.store') }}" method="POST">

        @csrf

        <label>نام محصول:</label>
        <input type="text" name="name">
        <br><br>

        <label>قیمت:</label>
        <input type="number" name="price">
        <br><br>

        <label>تعداد:</label>
        <input type="number" name="quantity">
        <br><br>

        <label>سازنده:</label>
        <input type="text" name="manufacturer">
        <br><br>

        <label>نوع محصول:</label>
        <input type="text" name="type">
        <br><br>

        <button type="submit">ثبت محصول</button>

    </form>

</body>

</html>