@extends('layouts.app')

@section('title', 'تاریخچه برداشت')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span>تاریخچه برداشت محصولات</span>
        <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">بازگشت به لیست محصولات</a>
    </div>

    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>شناسه برداشت</th>
                        <th>شناسه راننده</th>
                        <th>نام راننده</th>
                        <th>شناسه محصول</th>
                        <th>نام محصول</th>
                        <th>تعداد برداشت</th>
                        <th>تاریخ و زمان</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->id }}</td>
                        <td>{{ $withdrawal->user_id }}</td>
                        <td>{{ $withdrawal->user?->username ?? '-' }}</td>
                        <td>{{ $withdrawal->product_id }}</td>
                        <td>{{ $withdrawal->product_name }}</td>
                        <td>{{ $withdrawal->quantity }}</td>
                        <td>{{ verta($withdrawal->created_at)->format('Y/m/d H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            هنوز برداشتی ثبت نشده است.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection