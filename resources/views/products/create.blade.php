@extends('layouts.app')

@section('title', 'ثبت محصول')

@section('content')
    <div class="card">
        <div class="card-header">ثبت محصول جدید</div>

        <div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">نام محصول</label>
                    <input id="name" type="text" name="name" class="form-control"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">قیمت</label>
                    <input id="price" type="number" name="price" class="form-control"
                        min="0" step="0.01" value="{{ old('price') }}" required>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">تعداد</label>
                    <input id="quantity" type="number" name="quantity" class="form-control"
                        min="0" step="1" value="{{ old('quantity') }}" required>
                </div>

                <div class="mb-3">
                    <label for="manufacturer" class="form-label">سازنده</label>
                    <input id="manufacturer" type="text" name="manufacturer" class="form-control"
                        value="{{ old('manufacturer') }}" required>
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label">نوع محصول</label>
                    <input id="type" type="text" name="type" class="form-control"
                        value="{{ old('type') }}" required>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">ثبت محصول</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light">بازگشت به لیست محصولات</a>
                </div>
            </form>
        </div>
    </div>
@endsection
