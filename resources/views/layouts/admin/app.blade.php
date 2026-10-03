<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('admin_theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.classList.remove('dark-mode');
            }
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - رواد البرمجة</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/storage/logos/gFgrkcJxdSTSIAV3jegc7sRcYbGVZMT5hgKqQeX9.png') }}" type="image/png">

    <!-- Google Fonts - Cairo for Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Local Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.rtl.min.css') }}">

    <!-- Local Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

    <!-- Local Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome/css/all.min.css') }}">

    <!-- Local SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- Local Animate.css -->
    <link rel="stylesheet" href="{{ asset('public/vendor/animate/animate.min.css') }}">

    <!-- Local Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/select2/css/select2.min.css') }}">

    <!-- Local Flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/flatpickr/flatpickr.min.css') }}">

    <!-- Admin Design System CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin/css/admin.css') }}">

    @stack('styles')
</head>

<body>
    @yield('content')
    @yield('auth-content')

    <!-- Local jQuery -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Local Bootstrap 5 JS Bundle -->
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Local ApexCharts -->
    <script src="{{ asset('public/vendor/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Local SweetAlert2 -->
    <script src="{{ asset('public/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Local Select2 -->
    <script src="{{ asset('public/vendor/select2/js/select2.min.js') }}"></script>

    <!-- Local Flatpickr & Arabic Locale -->
    <script src="{{ asset('public/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/vendor/flatpickr/l10n/ar.js') }}"></script>

    <!-- Local Axios HTTP Client -->
    <script src="{{ asset('public/vendor/axios/axios.min.js') }}"></script>

    <!-- Local Custom Admin Panel Scripts -->
    <script src="{{ asset('public/assets/admin/js/admin.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/fontawesome-fallback.js') }}"></script>

    @stack('scripts')
</body>

</html>