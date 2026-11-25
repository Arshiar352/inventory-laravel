<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'سیستم انبارداری')</title>

    @include('partials.styles')
</head>

<body>
    <nav class="navbar navbar-expand">
        <div class="container flex-wrap gap-3">

            <a class="navbar-brand mb-0" href="{{ route('home') }}">سیستم انبارداری</a>

            <div class="navbar-nav flex-row align-items-center gap-3">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">خانه</a>
                <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">محصولات</a>
                <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">پروفایل</a>

                <div class="dropdown">
                    <button
                        class="btn btn-outline-light btn-sm dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        🔔

                        @if ($unreadNotificationsCount > 0)
                        <span class="badge bg-danger">
                            {{ $unreadNotificationsCount }}
                        </span>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end p-2" style="min-width: 300px;">

                        @forelse ($notifications as $notification)

                        <li class="mb-2">
                            <div class="dropdown-item-text rounded p-2">

                                <strong>
                                    {{ $notification->data['title'] ?? 'اعلان' }}
                                </strong>

                                <p class="mb-2">
                                    {{ $notification->data['message'] ?? '' }}
                                </p>

                                @if (!$notification->read_at)
                                <form
                                    action="{{ route('notifications.read', $notification->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-sm btn-primary">
                                        خواندم
                                    </button>
                                </form>
                                @else
                                <small class="text-muted">خوانده شده</small>
                                @endif

                            </div>
                        </li>

                        @empty
                        <li>
                            <span class="dropdown-item-text">
                                اعلانی وجود ندارد.
                            </span>
                        </li>
                        @endforelse

                    </ul>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">خروج</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @include('partials.alerts')

        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>