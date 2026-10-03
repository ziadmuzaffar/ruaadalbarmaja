<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('website_theme') || 'light';
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
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="ar" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    <!-- Search Engine Directives & Robots -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <!-- Primary SEO Meta Tags -->
    <title>@yield('title', ($company->name ?? 'رواد البرمجة') . ' | أفضل شركة برمجة وتطوير مواقع وتطبيقات في السعودية')</title>
    <meta name="title" content="@yield('title', ($company->name ?? 'رواد البرمجة') . ' | أفضل شركة برمجة وتطوير مواقع وتطبيقات في السعودية')">
    <meta name="description" content="@yield('meta_description', $company->description ?? 'الشركة الرائدة في مجال البرمجة وتطوير البرمجيات وتطبيقات الهواتف والمواقع والحلول الرقمية المتكاملة بالمملكة العربية السعودية والشرق الأوسط.')">
    <meta name="keywords" content="رواد البرمجة, شركة برمجة في السعودية, برمجة وتصميم مواقع, تطوير تطبيقات الجوال, تصميم متجر إلكتروني, حلول الذكاء الاصطناعي, أنظمة ERP سحابية, تطوير البرمجيات, الرياض, السعودية, استشارات تقنية">
    <meta name="author" content="{{ $company->name ?? 'رواد البرمجة' }}">
    <meta name="publisher" content="{{ $company->name ?? 'رواد البرمجة' }}">
    <meta name="language" content="ar">

    <!-- Geo & Local SEO Tags -->
    <meta name="geo.region" content="SA">
    <meta name="geo.placename" content="{{ $company->city ?? 'الرياض' }}">
    <meta name="geo.position" content="24.7136;46.6753">
    <meta name="ICBM" content="24.7136, 46.6753">

    <!-- Mobile & PWA Optimization -->
    <meta name="theme-color" content="#4f46e5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ $company->name ?? 'رواد البرمجة' }}">

    @php
        $siteLogo = isset($company->logo) && $company->logo ? asset('public/storage/' . $company->logo) : asset('public/storage/logos/gFgrkcJxdSTSIAV3jegc7sRcYbGVZMT5hgKqQeX9.png');
        $siteName = $company->name ?? 'رواد البرمجة';
        $siteDesc = $company->description ?? 'نبتكر الحلول الرقمية المتكاملة لتطوير أعمالك ونقلها للمستقبل بأحدث تقنيات البرمجة والذكاء الاصطناعي.';
    @endphp

    <!-- Open Graph / Facebook / WhatsApp / LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $siteName . ' | حلول البرمجيات والتطبيقات المتكاملة')">
    <meta property="og:description" content="@yield('meta_description', $siteDesc)">
    <meta property="og:image" content="{{ $siteLogo }}">
    <meta property="og:image:secure_url" content="{{ $siteLogo }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $siteName }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', $siteName . ' | حلول البرمجيات والتطبيقات المتكاملة')">
    <meta name="twitter:description" content="@yield('meta_description', $siteDesc)">
    <meta name="twitter:image" content="{{ $siteLogo }}">
    <meta name="twitter:image:alt" content="{{ $siteName }}">

    @php
        $socialLinks = array_values(array_filter([
            $company->facebook_url ?? null,
            $company->twitter_url ?? null,
            $company->linkedin_url ?? null,
            $company->instagram_url ?? null,
            $company->tiktok_url ?? null,
        ]));

        $schemaGraph = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => url('/') . '/#organization',
                    'name' => $siteName,
                    'url' => url('/'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        '@id' => url('/') . '/#logo',
                        'url' => $siteLogo,
                        'caption' => $siteName,
                    ],
                    'image' => $siteLogo,
                    'description' => $siteDesc,
                    'email' => $company->email ?? 'info@ruaadalbarmaja.com',
                    'telephone' => $company->phone ?? '+966500000000',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $company->street ?? $company->district ?? 'حي السلي',
                        'addressLocality' => $company->city ?? 'الرياض',
                        'addressRegion' => 'Riyadh',
                        'addressCountry' => 'SA',
                    ],
                    'sameAs' => !empty($socialLinks) ? $socialLinks : [url('/')],
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '/#website',
                    'url' => url('/'),
                    'name' => $siteName,
                    'description' => $siteDesc,
                    'publisher' => [
                        '@id' => url('/') . '/#organization',
                    ],
                    'inLanguage' => 'ar',
                ],
                [
                    '@type' => 'ProfessionalService',
                    '@id' => url('/') . '/#service',
                    'name' => $siteName,
                    'url' => url('/'),
                    'logo' => $siteLogo,
                    'image' => $siteLogo,
                    'priceRange' => '$$',
                    'telephone' => $company->phone ?? '+966500000000',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => $company->city ?? 'الرياض',
                        'addressCountry' => 'SA',
                    ],
                    'openingHoursSpecification' => [
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                        'opens' => '09:00',
                        'closes' => '18:00',
                    ],
                ],
            ],
        ];
    @endphp

    <!-- Structured Data (JSON-LD) for Search Engines -->
    <script type="application/ld+json">
    {!! json_encode($schemaGraph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @stack('seo_schema')

    <!-- Favicon -->
    <link rel="icon" href="{{ $siteLogo }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ $siteLogo }}">

    <!-- Google Fonts - Cairo for Arabic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Local Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.rtl.min.css') }}">

    <!-- Local Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

    <!-- Local Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome/css/all.min.css') }}">

    <!-- Local Animate.css -->
    <link rel="stylesheet" href="{{ asset('public/vendor/animate/animate.min.css') }}">

    <!-- Local SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- Custom Website Design System CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/website/css/website.css') }}">

    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    @include('layouts.website.navbar')

    <!-- Main Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Floating WhatsApp Action -->
    @if(!empty($company->whatsapp) || !empty($company->phone))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp ?? $company->phone) }}?text={{ urlencode('مرحباً شركة رواد البرمجة، أرغب في الاستفسار عن خدماتكم.') }}" 
           target="_blank" 
           class="floating-whatsapp" 
           title="تواصل معنا عبر واتساب"
           aria-label="WhatsApp Contact">
            <i class="bi bi-whatsapp"></i>
        </a>
    @endif

    <!-- Footer -->
    @include('layouts.website.footer')

    <!-- Local jQuery -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Local Bootstrap 5 Bundle JS -->
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Local SweetAlert2 JS -->
    <script src="{{ asset('public/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Local Axios JS -->
    <script src="{{ asset('public/vendor/axios/axios.min.js') }}"></script>

    <!-- Custom Website Script -->
    <script src="{{ asset('public/assets/website/js/website.js') }}"></script>

    @stack('scripts')
</body>

</html>
