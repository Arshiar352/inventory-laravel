<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'سیستم انبارداری')</title>

    @include('partials.styles')
</head>

<body>
    <main class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-4">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <h1 class="h3 text-center mb-4">سیستم انبارداری</h1>

                <div class="card shadow">
                    <div class="card-body p-4">
                        @include('partials.alerts')

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>