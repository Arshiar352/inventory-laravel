<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ثبت محصول</title>
</head>

<body>

    <h1>ثبت محصول جدید</h1>

    <a href="{{ route('products.index') }}">بازگشت به لیست محصولات</a>

    <br><br>

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
        <input type="text" name="name" value="{{ old('name') }}">
        <br><br>

        <label>قیمت:</label>
        <input type="number" name="price" min="0" step="0.01"
            value="{{ old('price') }}">
        <br><br>

        <label>تعداد:</label>
        <input type="number" name="quantity" min="0" step="1"
            value="{{ old('quantity') }}">
        <br><br>

        <label>سازنده:</label>
        <input type="text" name="manufacturer"
            value="{{ old('manufacturer') }}">
        <br><br>

        <label>نوع محصول:</label>
        <input type="text" name="type"
            value="{{ old('type') }}">
        <br><br>

        <button type="submit">ثبت محصول</button>

    </form>

</body>

</html>