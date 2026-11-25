@extends('layouts.app')

@section('title', 'ویرایش محصول')

@section('content')
    <div class="card">
        <div class="card-header">ویرایش محصول</div>

        <div class="card-body p-4">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">نام محصول</label>
                    <input id="name" type="text" name="name" class="form-control"
                        value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">قیمت</label>
                    <input id="price" type="number" name="price" class="form-control"
                        min="0" step="0.01" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">تعداد</label>
                    <input id="quantity" type="number" name="quantity" class="form-control"
                        min="0" step="1" value="{{ old('quantity', $product->quantity) }}" required>
                </div>

                <div class="mb-3">
                    <label for="manufacturer" class="form-label">سازنده</label>
                    <input id="manufacturer" type="text" name="manufacturer" class="form-control"
                        value="{{ old('manufacturer', $product->manufacturer) }}" required>
                </div>

                <div class="mb-4">
                    <label for="type" class="form-label">نوع محصول</label>
                    <input id="type" type="text" name="type" class="form-control"
                        value="{{ old('type', $product->type) }}" required>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light">بازگشت به لیست محصولات</a>
                </div>
            </form>
        </div>
    </div>
@endsection
