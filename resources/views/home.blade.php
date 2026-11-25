@extends('layouts.app')

@section('title', 'خانه')

@section('content')
    <div class="card">
        <div class="card-body p-4">
            <h1 class="h3 mb-2">به سیستم انبارداری خوش آمدید</h1>
            <p class="mb-4">شما با موفقیت وارد سیستم شده اید.</p>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-primary">مدیریت محصولات</a>
                <a href="{{ route('profile') }}" class="btn btn-outline-light">پروفایل من</a>
            </div>
        </div>
    </div>
@endsection
