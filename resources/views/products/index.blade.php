@extends('layouts.app')

@section('title', 'مدیریت محصولات')

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>مدیریت محصولات انبار</span>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">ثبت محصول جدید</a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-4">
                <div class="col-12 col-md-9">
                    <input type="text" name="search" class="form-control"
                        placeholder="نام محصول، شرکت سازنده یا نوع محصول..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">جستجو</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light flex-fill">پاک کردن</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $product['id']) }}"
                                            class="btn btn-primary btn-sm px-3">ویرایش</a>

                                        <form action="{{ route('products.destroy', $product['id']) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    هنوز محصولی ثبت نشده است.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
