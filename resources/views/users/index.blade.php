@extends('layouts.app')

@section('title', 'مدیریت کاربران')

@section('content')
    <div class="card">
        <div class="card-header">مدیریت کاربران</div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام کاربری</th>
                            <th>ایمیل</th>
                            <th>نقش</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->join('، ') ?: 'بدون نقش' }}</td>
                                <td>
                                    @if (!$user->hasRole('admin'))
                                        <form action="{{ route('users.grant-admin', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary btn-sm">اعطای نقش Admin</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Admin</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">کاربری ثبت نشده است.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
