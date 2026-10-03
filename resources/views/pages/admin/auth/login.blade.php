@extends('layouts.admin.app')

@section('title', 'تسجيل الدخول - لوحة التحكم')

@push('styles')
<style>
    :root {
        --brand-cyan: #0284c7;
        --brand-blue: #2563eb;
        --brand-indigo: #4f46e5;
        --brand-purple: #7c3aed;
        --brand-dark: #0f172a;
        --gradient-primary: linear-gradient(135deg, #0284c7 0%, #2563eb 50%, #7c3aed 100%);
        --font-main: 'Cairo', system-ui, -apple-system, sans-serif;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: var(--font-main);
        background-color: #f8fafc;
        color: #0f172a;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-x: hidden;
    }

    /* Container & Split Layout */
    .login-wrapper {
        width: 100%;
        min-height: 100vh;
        display: flex;
    }

    /* Hero / Brand Section (Side 1 - Light Theme) */
    .login-hero {
        flex: 1.1;
        background: linear-gradient(135deg, #f0f7ff 0%, #eef2ff 50%, #f5f3ff 100%);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 4rem;
        overflow: hidden;
        border-left: 1px solid #e2e8f0;
    }

    /* Ambient Light Glow Orbs */
    .login-hero::before {
        content: '';
        position: absolute;
        top: -15%;
        right: -15%;
        width: 550px;
        height: 550px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.18) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        filter: blur(50px);
        animation: pulseGlow 8s infinite alternate ease-in-out;
    }

    .login-hero::after {
        content: '';
        position: absolute;
        bottom: -15%;
        left: -15%;
        width: 550px;
        height: 550px;
        background: radial-gradient(circle, rgba(167, 139, 250, 0.18) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        filter: blur(50px);
        animation: pulseGlow 10s infinite alternate ease-in-out 2s;
    }

    @keyframes pulseGlow {
        0% {
            transform: scale(1) translate(0, 0);
            opacity: 0.8;
        }

        100% {
            transform: scale(1.15) translate(20px, -20px);
            opacity: 1;
        }
    }

    /* Tech Grid Pattern Overlay */
    .tech-pattern {
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(rgba(15, 23, 42, 0.05) 1px, transparent 1px),
            linear-gradient(to right, rgba(15, 23, 42, 0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(15, 23, 42, 0.02) 1px, transparent 1px);
        background-size: 30px 30px, 60px 60px, 60px 60px;
        opacity: 0.7;
        pointer-events: none;
    }

    .hero-header {
        position: relative;
        z-index: 2;
    }

    .hero-logo-wrapper {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1.25rem;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 50rem;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05);
    }

    .hero-logo-img {
        height: 44px;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 2px 6px rgba(2, 132, 199, 0.2));
    }

    .hero-brand-name {
        font-size: 1.2rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .hero-body {
        position: relative;
        z-index: 2;
        margin: auto 0;
        max-width: 540px;
    }

    .hero-title {
        font-size: 2.75rem;
        font-weight: 900;
        line-height: 1.25;
        margin-bottom: 1.25rem;
        color: #0f172a;
    }

    .hero-title-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: #475569;
        line-height: 1.75;
        margin-bottom: 2.5rem;
        font-weight: 400;
    }

    /* Feature Badges (Light) */
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        background: #ffffff;
        border-color: #bae6fd;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(2, 132, 199, 0.08);
    }

    .feature-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
    }

    .feature-icon-cyan {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .feature-icon-purple {
        background: #f3e8ff;
        color: #7c3aed;
        border: 1px solid #e9d5ff;
    }

    .feature-icon-blue {
        background: #dbeafe;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .feature-icon-emerald {
        background: #d1fae5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .feature-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.25rem;
    }

    .feature-desc {
        font-size: 0.825rem;
        color: #64748b;
        margin: 0;
    }

    .hero-footer {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 0.875rem;
    }

    /* Form Section (Side 2 - Light Theme) */
    .login-form-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 3rem 2rem;
        background-color: #ffffff;
        position: relative;
    }

    .login-card {
        width: 100%;
        max-width: 440px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 2.5rem 2.25rem;
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.07);
        position: relative;
        z-index: 2;
    }

    .form-header {
        text-align: center;
        margin-bottom: 2.25rem;
    }

    .mobile-logo {
        display: none;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .mobile-logo img {
        height: 60px;
        width: auto;
    }

    .form-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        border-radius: 50rem;
        background: #e0f2fe;
        color: #0284c7;
        font-size: 0.825rem;
        font-weight: 700;
        border: 1px solid #bae6fd;
        margin-bottom: 1rem;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        font-size: 0.925rem;
        color: #64748b;
    }

    /* Form Inputs */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #334155;
        margin-bottom: 0.5rem;
        display: block;
    }

    .input-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        right: 1.25rem;
        color: #94a3b8;
        font-size: 1.1rem;
        transition: color 0.3s ease;
        pointer-events: none;
    }

    .custom-input {
        width: 100%;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        padding: 0.85rem 3rem 0.85rem 1.25rem;
        font-family: inherit;
        font-size: 0.95rem;
        color: #0f172a;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .custom-input::placeholder {
        color: #94a3b8;
    }

    .custom-input:focus {
        outline: none;
        border-color: #0284c7;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
        color: #0f172a;
    }

    .custom-input:focus+.input-icon,
    .input-icon-wrapper:focus-within .input-icon {
        color: #0284c7;
    }

    .password-toggle-btn {
        position: absolute;
        left: 1rem;
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .password-toggle-btn:hover {
        color: #0284c7;
    }

    /* Checkbox & Options */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        font-size: 0.875rem;
    }

    .custom-checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        user-select: none;
        color: #334155;
    }

    .custom-checkbox-wrapper input {
        display: none;
    }

    .checkbox-box {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background-color: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        color: transparent;
        font-size: 0.75rem;
    }

    .custom-checkbox-wrapper input:checked+.checkbox-box {
        background: var(--gradient-primary);
        border-color: transparent;
        color: #ffffff;
        box-shadow: 0 0 10px rgba(2, 132, 199, 0.25);
    }

    .forgot-link {
        color: #0284c7;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .forgot-link:hover {
        color: #0369a1;
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 0.9rem;
        border: none;
        border-radius: 14px;
        background: var(--gradient-primary);
        color: #ffffff;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transition: left 0.6s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(124, 58, 237, 0.35);
        color: #ffffff;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Alert Messages */
    .custom-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        color: #991b1b;
        font-size: 0.875rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .custom-alert i {
        font-size: 1.1rem;
        margin-top: 0.1rem;
        color: #dc2626;
    }

    .invalid-feedback-custom {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* Form Footer */
    .form-footer {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.825rem;
        color: #64748b;
    }

    .form-footer a {
        color: #0284c7;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .form-footer a:hover {
        color: #0369a1;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .login-hero {
            display: none;
        }

        .login-form-container {
            padding: 2rem 1.25rem;
            background: linear-gradient(135deg, #f0f7ff 0%, #f8fafc 100%);
        }

        .mobile-logo {
            display: flex;
        }

        .login-card {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endpush

@section('auth-content')
<div class="login-wrapper">
    <!-- Part 1: Branding & Visual Section (الجانب البصري والهوية - الفاتح) -->
    <div class="login-hero">
        <div class="tech-pattern"></div>

        <!-- Top Header Logo -->
        <div class="hero-header">
            <div class="hero-logo-wrapper">
                <img src="{{ asset('public/storage/' . $companyInfo->logo) }}" alt="رواد البرمجة" class="hero-logo-img">
                <span class="hero-brand-name">{{ $companyInfo->name }}</span>
            </div>
        </div>

        <!-- Hero Body Content -->
        <div class="hero-body">
            <h1 class="hero-title">
                نُصمم المستقبل <br>
                <span class="hero-title-gradient">بحلول برمجية مبتكرة</span>
            </h1>
            <p class="hero-subtitle">
                مرحباً بك في لوحة تحكم منصة رواد البرمجة. أدر خدماتك، مشاريعك، وإحصائيات عملائك بكل مرونة وأمان في مكان واحد.
            </p>

            <!-- Key Feature Highlights -->
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon feature-icon-cyan">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <h4 class="feature-title">أمان متقدم</h4>
                    <p class="feature-desc">حماية كاملة لبياناتك وتشفير عالي المستوى.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-purple">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="feature-title">أداء فائق السرعة</h4>
                    <p class="feature-desc">إدارة واستجابة فورية لكافة العمليات.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-blue">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h4 class="feature-title">تحليلات متكاملة</h4>
                    <p class="feature-desc">تقارير دقيقة ومؤشرات أداء مباشرة.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon feature-icon-emerald">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">دعم فني دائم</h4>
                    <p class="feature-desc">فريقنا متواجد ومستعد لمساعدتك دائماً.</p>
                </div>
            </div>
        </div>

        <!-- Hero Footer -->
        <div class="hero-footer">
            <span>رواد البرمجة &copy; {{ date('Y') }}</span>
            <span><i class="fas fa-code text-primary me-1"></i> تطوير نظم برمجية احترافية</span>
        </div>
    </div>

    <!-- Part 2: Login Form Section (نموذج تسجيل الدخول - الفاتح) -->
    <div class="login-form-container">
        <div class="login-card">

            <!-- Logo Display for Mobile Screens -->
            <div class="mobile-logo">
                <img src="{{ asset('public/storage/logos/gFgrkcJxdSTSIAV3jegc7sRcYbGVZMT5hgKqQeX9.png') }}" alt="رواد البرمجة">
            </div>

            <!-- Form Header -->
            <div class="form-header">
                <div class="form-badge">
                    <i class="fas fa-lock"></i>
                    <span>منطقة المشرفين</span>
                </div>
                <h2 class="form-title">تسجيل الدخول</h2>
                <p class="form-subtitle">يرجى إدخال بيانات حسابك للمتابعة إلى لوحة التحكم</p>
            </div>

            <!-- Validation & Global Error Display -->
            @if ($errors->any())
            <div class="custom-alert">
                <i class="fas fa-circle-exclamation"></i>
                <div>
                    <strong>تعذر تسجيل الدخول!</strong>
                    <div class="mt-1">
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if (session('status'))
            <div class="custom-alert" style="background: #f0fdf4; border-color: #bbf7d0; color: #166534;">
                <i class="fas fa-check-circle" style="color: #16a34a;"></i>
                <div>{{ session('status') }}</div>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <div class="input-icon-wrapper">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="custom-input @error('email') is-invalid @enderror"
                            placeholder="admin@ruaad.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    @error('email')
                    <div class="invalid-feedback-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <div class="input-icon-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="custom-input @error('password') is-invalid @enderror"
                            placeholder="••••••••••••"
                            required
                            autocomplete="current-password">
                        <i class="fas fa-lock input-icon"></i>
                        <button type="button" class="password-toggle-btn" id="togglePassword" title="إظهار / إخفاء كلمة المرور">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                    <div class="invalid-feedback-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Options: Remember Me & Forgot Password -->
                <div class="form-options">
                    <label class="custom-checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkbox-box"><i class="fas fa-check"></i></span>
                        <span>تذكر بياناتي</span>
                    </label>

                    <a href="#" onclick="alert('يرجى التواصل مع مدير النظام لإعادة تعيين كلمة المرور.'); return false;" class="forgot-link">
                        نسيت كلمة المرور؟
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>دخول لوحة التحكم</span>
                    <i class="fas fa-arrow-left"></i>
                </button>
            </form>

            <!-- Card Footer -->
            <div class="form-footer">
                <p class="mb-0">
                    هل تواجه مشكلة؟
                    <a href="{{ route('admin.help') ?? '#' }}">مركز الدعم والمساعدة</a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Password Show / Hide Toggle
        $('#togglePassword').on('click', function() {
            const $passwordInput = $('#password');
            const $toggleIcon = $('#toggleIcon');
            if ($passwordInput.length && $toggleIcon.length) {
                const isPassword = $passwordInput.attr('type') === 'password';
                $passwordInput.attr('type', isPassword ? 'text' : 'password');
                $toggleIcon.toggleClass('fa-eye', !isPassword).toggleClass('fa-eye-slash', isPassword);
            }
        });

        // Form Submit Button Animation
        $('#loginForm').on('submit', function() {
            const $submitBtn = $('#submitBtn');
            if ($submitBtn.length) {
                $submitBtn.prop('disabled', true).css('opacity', '0.85').html(`
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    جاري تسجيل الدخول...
                `);
            }
        });
    });
</script>
@endpush