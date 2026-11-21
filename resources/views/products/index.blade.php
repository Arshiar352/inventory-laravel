<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>محصولات انبار</title>
</head>

<body>

    <h1>لیست محصولات</h1>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>نام محصول</th>
                <th>قیمت</th>
                <th>تعداد</th>
                <th>سازنده</th>
                <th>نوع</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->manufacturer }}</td>
                <td>{{ $product->type }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">هنوز محصولی ثبت نشده است.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>