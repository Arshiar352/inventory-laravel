<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
</head>

<body>

    <h1>مدیریت محصولات انبار</h1>

    <a href="{{ route('products.create') }}">ثبت محصول جدید</a>

    <br><br>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('products.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="نام محصول، شرکت سازنده یا نوع محصول..."
            value="{{ request('search') }}">

        <button type="submit">جستجو</button>

        <a href="{{ route('products.index') }}">پاک کردن جستجو</a>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>نام محصول</th>
                <th>قیمت</th>
                <th>تعداد</th>
                <th>سازنده</th>
                <th>نوع محصول</th>
                <th>عملیات</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($products as $product)

            <tr>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>{{ $product['manufacturer'] }}</td>
                <td>{{ $product['type'] }}</td>

                <td>
                    <a href="{{ route('products.edit', $product['id']) }}">
                        ویرایش
                    </a>

                    |

                    <form
                        action="{{ route('products.destroy', $product['id']) }}"
                        method="POST"
                        style="display: inline;"
                        onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                        @csrf
                        @method('DELETE')

                        <button type="submit">حذف</button>
                    </form>
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="6">
                    هنوز محصولی ثبت نشده است.
                </td>
            </tr>

            @endforelse

        </tbody>
    </table>

</body>

</html>