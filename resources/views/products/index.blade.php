@extends('layouts.app')

@section('title', 'مدیریت محصولات')

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>مدیریت محصولات انبار</span>

            <div class="d-flex flex-wrap gap-2">
                @can('view withdrawal history')
                    <a href="{{ route('withdrawals.index') }}" class="btn btn-outline-light btn-sm">تاریخچه برداشت</a>
                @endcan

                @can('create products')
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">ثبت محصول جدید</a>
                @endcan
            </div>
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
                            <th>وضعیت</th>
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
                                    @if ($product['is_active'])
                                        <span class="badge bg-success">فعال</span>
                                    @else
                                        <span class="badge bg-secondary">غیرفعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        @can('withdraw products')
                                            @if ($product['is_active'] && $product['quantity'] > 0)
                                                <form action="{{ route('products.withdraw', $product['id']) }}"
                                                    method="POST" class="d-flex gap-1 align-items-center">
                                                    @csrf
                                                    <input type="number" name="quantity"
                                                        class="form-control form-control-sm" style="width: 90px;"
                                                        min="1" max="{{ $product['quantity'] }}"
                                                        placeholder="تعداد" aria-label="تعداد برداشت" required>
                                                    <button type="submit" class="btn btn-success btn-sm">برداشت</button>
                                                </form>
                                            @endif
                                        @endcan

                                        @can('edit products')
                                            <a href="{{ route('products.edit', $product['id']) }}"
                                                class="btn btn-primary btn-sm px-3">ویرایش</a>
                                        @endcan

                                        @can('manage product status')
                                            <form action="{{ route('products.status', $product['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                    class="btn btn-outline-{{ $product['is_active'] ? 'warning' : 'success' }} btn-sm">
                                                    {{ $product['is_active'] ? 'غیرفعال کردن' : 'فعال کردن' }}
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
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
