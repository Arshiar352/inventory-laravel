@extends('layouts.app')

@section('title', 'پروفایل کاربر')

@section('content')
    <div class="card">
        <div class="card-header">پروفایل من</div>

        <div class="card-body p-4">
            @if ($user->profile_picture)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" width="120"
                        class="rounded-circle" alt="عکس پروفایل">
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="username" class="form-label">نام کاربری</label>
                    <input id="username" type="text" name="username" class="form-control"
                        value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">ایمیل</label>
                    <input id="email" type="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">موبایل</label>
                    <input id="mobile" type="text" class="form-control" value="{{ $user->mobile }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="birth_date" class="form-label">تاریخ تولد</label>
                    <input id="birth_date" type="text" name="birth_date" class="form-control"
                        value="{{ old('birth_date', $birthDate) }}" placeholder="1400/05/20" required>
                    <div class="form-text">سن: {{ $age }} سال</div>
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="form-label">عکس پروفایل</label>
                    <input id="profile_picture" type="file" name="profile_picture"
                        class="form-control" accept="image/*">
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-light">بازگشت به خانه</a>
                </div>
            </form>
        </div>
    </div>
@endsection
