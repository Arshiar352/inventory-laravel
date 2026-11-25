{{-- Bootstrap from CDN, so there is nothing to install or build. --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

<style>
    body {
        background-color: #0b1b30;
        color: #e9f1fb;
    }

    a {
        color: #8fc0f0;
    }

    a:hover {
        color: #bcdcfb;
    }

    .navbar {
        background-color: #061529;
    }

    .navbar-brand,
    .nav-link {
        color: #dce8f7 !important;
    }

    .nav-link.active {
        color: #7db4f5 !important;
    }

    .card {
        background-color: #122b49;
        color: #e9f1fb;
        border-color: #2a4c72;
    }

    .card-header {
        background-color: #0f2642;
        border-color: #2a4c72;
    }

    .table {
        --bs-table-bg: #122b49;
        --bs-table-color: #e9f1fb;
        --bs-table-border-color: #2a4c72;
        --bs-table-hover-bg: #1a3b63;
        --bs-table-hover-color: #ffffff;
    }

    .table > :not(caption) > * > * {
        border-color: #2a4c72;
    }

    .form-label {
        color: #cfe0f3;
    }

    .form-control {
        background-color: #0f2642;
        color: #e9f1fb;
        border-color: #2a4c72;
    }

    .form-control::placeholder {
        color: #8ba6c4;
    }

    .form-control:focus {
        background-color: #102a48;
        color: #ffffff;
        border-color: #5b9bd5;
        box-shadow: 0 0 0 0.2rem rgba(91, 155, 213, 0.25);
    }

    .form-control:disabled {
        background-color: #1a3352;
        color: #a9bfd7;
    }

    .form-text,
    .text-muted {
        color: #9fb6d0 !important;
    }

    .btn-primary {
        --bs-btn-bg: #2563a8;
        --bs-btn-border-color: #2563a8;
        --bs-btn-hover-bg: #1d4e88;
        --bs-btn-hover-border-color: #1d4e88;
        --bs-btn-active-bg: #173d6b;
        --bs-btn-active-border-color: #173d6b;
    }

    .alert-success {
        --bs-alert-bg: #143d2c;
        --bs-alert-color: #c4efd5;
        --bs-alert-border-color: #27624a;
    }

    .alert-danger {
        --bs-alert-bg: #4a1f28;
        --bs-alert-color: #f4cbd2;
        --bs-alert-border-color: #7a3543;
    }
</style>
