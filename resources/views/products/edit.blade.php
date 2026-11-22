<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ویرایش محصول</title>
</head>

<body>

    <h1>ویرایش محصول</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>نام محصول:</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        <br><br>

        <label>قیمت:</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}">
        <br><br>

        <label>تعداد:</label>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}">
        <br><br>

        <label>سازنده:</label>
        <input type="text" name="manufacturer" value="{{ old('manufacturer', $product->manufacturer) }}">
        <br><br>

        <label>نوع محصول:</label>
        <input type="text" name="type" value="{{ old('type', $product->type) }}">
        <br><br>

        <button type="submit">ذخیره تغییرات</button>

    </form>

</body>

</html>