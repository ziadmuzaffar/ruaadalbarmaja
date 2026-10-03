<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0f172a">

    @php
        $siteName = $company->name ?? 'رواد البرمجة';
        $siteLogo = !empty($company->logo) ? asset('public/storage/' . $company->logo) : asset('public/storage/logos/gFgrkcJxdSTSIAV3jegc7sRcYbGVZMT5hgKqQeX9.png');
        $maintenanceTitle = $company->maintenance_title ?: 'الموقع قيد الصيانة والتطوير حالياً';
        $maintenanceMessage = $company->maintenance_message ?: 'نعمل حالياً على تحديث وتطوير أنظمتنا البرمجية لنقدم لكم تجربة رقمية استثنائية وأكثر تميزاً. سنعود للعمل قريباً جداً!';
        $endsAt = $company->maintenance_ends_at ? $company->maintenance_ends_at->format('Y-m-d\TH:i:s') : null;
    @endphp

    <title>{{ $maintenanceTitle }} | {{ $siteName }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ $siteLogo }}" type="image/png">

    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Local Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/css/bootstrap.rtl.min.css') }}">
    <!-- Local Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome/css/all.min.css') }}">

    <style>
        :root {
            --primary-glow: #6366f1;
            --secondary-glow: #06b6d4;
            --accent-glow: #ec4899;
            --bg-dark: #0a0f1d;
            --card-bg: rgba(17, 24, 39, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
        }

        * {
            box-sizing: border-box;
            font-family: 'Cairo', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 2rem 1rem;
        }

        /* Ambient Animated Mesh Background */
        .ambient-glow {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.28;
            pointer-events: none;
            z-index: 0;
            animation: floatGlow 14s infinite alternate ease-in-out;
        }

        .ambient-glow-1 {
            background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%);
            top: -150px;
            right: -100px;
        }

        .ambient-glow-2 {
            background: radial-gradient(circle, var(--secondary-glow) 0%, transparent 70%);
            bottom: -150px;
            left: -100px;
            animation-delay: -7s;
        }

        .ambient-glow-3 {
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            height: 350px;
            opacity: 0.15;
        }

        @keyframes floatGlow {
            0% {
                transform: scale(1) translate(0, 0);
            }
            100% {
                transform: scale(1.15) translate(30px, 40px);
            }
        }

        /* Background Grid */
        .tech-grid-overlay {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        /* Container & Glass Card */
        .maintenance-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 820px;
            margin: auto;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            padding: 3rem 2.2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #06b6d4, #ec4899, #6366f1);
            background-size: 300% 100%;
            animation: gradientBorder 6s linear infinite;
        }

        @keyframes gradientBorder {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        /* Logo Branding */
        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 86px;
            height: 86px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
            padding: 10px;
            transition: transform 0.3s ease;
        }

        .brand-logo-wrap:hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .brand-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-name-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        /* Maintenance Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 9999px;
            background: rgba(234, 179, 8, 0.12);
            border: 1px solid rgba(234, 179, 8, 0.3);
            color: #facc15;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .status-pulse {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #facc15;
            box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.7);
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(234, 179, 8, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(234, 179, 8, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(234, 179, 8, 0);
            }
        }

        /* Animated Icon */
        .maintenance-icon-box {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            margin-bottom: 1.75rem;
        }

        .icon-circle-glow {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            animation: pulseGlow 3s infinite alternate ease-in-out;
        }

        @keyframes pulseGlow {
            0% { transform: scale(0.85); opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 1; }
        }

        .gear-icon {
            font-size: 3.5rem;
            background: linear-gradient(135deg, #60a5fa, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: spinGear 14s linear infinite;
        }

        .wrench-icon {
            position: absolute;
            font-size: 1.8rem;
            color: #38bdf8;
            bottom: 6px;
            left: 6px;
            filter: drop-shadow(0 2px 8px rgba(56, 189, 248, 0.6));
            animation: wiggle 3s infinite ease-in-out;
        }

        @keyframes spinGear {
            100% { transform: rotate(360deg); }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(-20deg); }
        }

        /* Typography */
        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.35;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: #94a3b8;
            line-height: 1.8;
            max-width: 650px;
            margin: 0 auto 2.2rem;
        }

        /* Countdown Grid */
        .countdown-wrap {
            margin-bottom: 2.5rem;
        }

        .countdown-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .countdown-grid {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .countdown-box {
            min-width: 95px;
            padding: 14px 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transition: transform 0.25s ease, border-color 0.25s ease;
        }

        .countdown-box:hover {
            transform: translateY(-3px);
            border-color: rgba(99, 102, 241, 0.4);
        }

        .countdown-value {
            font-size: 2.1rem;
            font-weight: 800;
            color: #38bdf8;
            line-height: 1.1;
            font-variant-numeric: tabular-nums;
        }

        .countdown-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* Shimmer Progress bar fallback when no end date is configured */
        .progress-fallback {
            max-width: 520px;
            margin: 0 auto 2.5rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
        }

        .progress-bar-glow {
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            position: relative;
            margin-top: 10px;
        }

        .progress-bar-fill {
            height: 100%;
            width: 82%;
            background: linear-gradient(90deg, #6366f1, #38bdf8);
            border-radius: 999px;
            position: relative;
            animation: shimmerBar 2.5s infinite;
        }

        @keyframes shimmerBar {
            0% { opacity: 0.8; }
            50% { opacity: 1; }
            100% { opacity: 0.8; }
        }

        /* Actions & Contact Buttons */
        .actions-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .btn-contact {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 22px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-whatsapp {
            background: #25d366;
            color: #ffffff;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.35);
        }

        .btn-whatsapp:hover {
            background: #20bd5a;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
        }

        .btn-email {
            background: rgba(255, 255, 255, 0.06);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .btn-email:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.25);
        }

        .btn-phone {
            background: rgba(56, 189, 248, 0.12);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
        }

        .btn-phone:hover {
            background: rgba(56, 189, 248, 0.22);
            color: #7dd3fc;
            transform: translateY(-2px);
        }

        /* Social Icons */
        .social-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
        }

        .social-link {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .social-link:hover {
            color: #ffffff;
            background: rgba(99, 102, 241, 0.25);
            border-color: rgba(99, 102, 241, 0.5);
            transform: translateY(-2px);
        }

        /* Footer */
        .page-footer {
            margin-top: 2rem;
            text-align: center;
            color: #64748b;
            font-size: 0.88rem;
            position: relative;
            z-index: 1;
        }

        .admin-login-link {
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.82rem;
        }

        .admin-login-link:hover {
            color: #94a3b8;
            background: rgba(255, 255, 255, 0.05);
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 2.2rem 1.4rem;
                border-radius: 22px;
            }

            .hero-title {
                font-size: 1.65rem;
            }

            .hero-desc {
                font-size: 0.98rem;
            }

            .countdown-box {
                min-width: 72px;
                padding: 10px 8px;
            }

            .countdown-value {
                font-size: 1.65rem;
            }

            .btn-contact {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Ambient Blur Orbs -->
    <div class="ambient-glow ambient-glow-1"></div>
    <div class="ambient-glow ambient-glow-2"></div>
    <div class="ambient-glow ambient-glow-3"></div>
    <div class="tech-grid-overlay"></div>

    <main class="maintenance-container">
        <div class="glass-card">
            <!-- Brand Logo -->
            <div class="brand-logo-wrap">
                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="brand-logo-img">
            </div>

            <div class="company-name-text">{{ $siteName }}</div>

            <!-- Maintenance Status Badge -->
            <div>
                <span class="status-badge">
                    <span class="status-pulse"></span>
                    <span>وضع الصيانة والتحديث الدوري</span>
                </span>
            </div>

            <!-- Animated Tech Graphic -->
            <div class="maintenance-icon-box">
                <div class="icon-circle-glow"></div>
                <i class="fas fa-cog gear-icon"></i>
                <i class="fas fa-tools wrench-icon"></i>
            </div>

            <!-- Main Heading & Message -->
            <h1 class="hero-title">{{ $maintenanceTitle }}</h1>
            <p class="hero-desc">{{ $maintenanceMessage }}</p>

            <!-- Countdown Timer (if configured) -->
            @if($endsAt)
            <div class="countdown-wrap">
                <div class="countdown-title">
                    <i class="fas fa-clock me-1 text-primary"></i> الموعد التقريبي للعودة للعمل
                </div>
                <div class="countdown-grid" id="maintenanceCountdown" data-target="{{ $endsAt }}">
                    <div class="countdown-box">
                        <span class="countdown-value" id="daysVal">00</span>
                        <span class="countdown-label">أيام</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-value" id="hoursVal">00</span>
                        <span class="countdown-label">ساعات</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-value" id="minutesVal">00</span>
                        <span class="countdown-label">دقائق</span>
                    </div>
                    <div class="countdown-box">
                        <span class="countdown-value" id="secondsVal">00</span>
                        <span class="countdown-label">ثواني</span>
                    </div>
                </div>
            </div>
            @else
            <!-- Progress Indicator fallback -->
            <div class="progress-fallback">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fs-13 text-light fw-semibold"><i class="fas fa-sync-alt fa-spin me-1 text-info"></i> جاري استكمال التحديثات وتجهيز الخوادم</span>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle">قريباً جداً</span>
                </div>
                <div class="progress-bar-glow">
                    <div class="progress-bar-fill"></div>
                </div>
            </div>
            @endif

            <!-- Contact & Social Actions -->
            <div class="actions-wrap">
                @if(!empty($company->whatsapp))
                @php
                    $cleanWhatsApp = preg_replace('/[^0-9]/', '', $company->whatsapp);
                @endphp
                <a href="https://wa.me/{{ $cleanWhatsApp }}?text={{ urlencode('مرحباً، أود الاستفسار بخصوص خدماتكم أثناء فترة صيانة الموقع.') }}" target="_blank" class="btn-contact btn-whatsapp">
                    <i class="fab fa-whatsapp fs-5"></i>
                    <span>تواصل معنا عبر واتساب</span>
                </a>
                @endif

                @if(!empty($company->phone))
                <a href="tel:{{ $company->phone }}" class="btn-contact btn-phone">
                    <i class="fas fa-phone-alt"></i>
                    <span>اتصال هاتفي</span>
                </a>
                @endif

                @if(!empty($company->email))
                <a href="mailto:{{ $company->email }}" class="btn-contact btn-email">
                    <i class="fas fa-envelope"></i>
                    <span>راسلنا عبر البريد</span>
                </a>
                @endif
            </div>

            <!-- Social Media Channels -->
            @php
                $hasSocial = !empty($company->facebook_url) || !empty($company->twitter_url) || !empty($company->linkedin_url) || !empty($company->instagram_url) || !empty($company->tiktok_url);
            @endphp

            @if($hasSocial)
            <div class="social-strip">
                @if(!empty($company->linkedin_url))
                <a href="{{ $company->linkedin_url }}" target="_blank" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
                @if(!empty($company->twitter_url))
                <a href="{{ $company->twitter_url }}" target="_blank" class="social-link" title="Twitter / X"><i class="fab fa-x-twitter"></i></a>
                @endif
                @if(!empty($company->instagram_url))
                <a href="{{ $company->instagram_url }}" target="_blank" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($company->facebook_url))
                <a href="{{ $company->facebook_url }}" target="_blank" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($company->tiktok_url))
                <a href="{{ $company->tiktok_url }}" target="_blank" class="social-link" title="TikTok"><i class="fab fa-tiktok"></i></a>
                @endif
            </div>
            @endif
        </div>

        <!-- Footer & Admin Access -->
        <footer class="page-footer">
            <p class="mb-2">جميع الحقوق محفوظة &copy; {{ date('Y') }} {{ $siteName }}</p>
            <a href="{{ route('admin.login') }}" class="admin-login-link">
                <i class="fas fa-shield-alt"></i>
                <span>بوابة دخول الإدارة</span>
            </a>
        </footer>
    </main>

    <!-- Countdown Timer Script -->
    <script>
        (function() {
            const countdownEl = document.getElementById('maintenanceCountdown');
            if (!countdownEl) return;

            const targetDateStr = countdownEl.getAttribute('data-target');
            if (!targetDateStr) return;

            const targetDate = new Date(targetDateStr).getTime();
            const daysEl = document.getElementById('daysVal');
            const hoursEl = document.getElementById('hoursVal');
            const minutesEl = document.getElementById('minutesVal');
            const secondsEl = document.getElementById('secondsVal');

            function pad(num) {
                return num < 10 ? '0' + num : num;
            }

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance <= 0) {
                    daysEl.innerText = '00';
                    hoursEl.innerText = '00';
                    minutesEl.innerText = '00';
                    secondsEl.innerText = '00';
                    const titleEl = document.querySelector('.countdown-title');
                    if (titleEl) {
                        titleEl.innerHTML = '<span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> تم الانتهاء من التحديثات، جاري فتح الموقع قريباً!</span>';
                    }
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                daysEl.innerText = pad(days);
                hoursEl.innerText = pad(hours);
                minutesEl.innerText = pad(minutes);
                secondsEl.innerText = pad(seconds);
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        })();
    </script>
</body>

</html>
