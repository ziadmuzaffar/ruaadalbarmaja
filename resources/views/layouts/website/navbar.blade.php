<nav class="navbar navbar-expand-lg navbar-custom glass-nav" id="mainNavbar">
    <div class="container">
        <!-- Brand Logo & Title -->
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(!empty($company->logo))
            <img src="{{ asset('public/storage/' . $company->logo) }}" alt="{{ $company->name }}">
            @else
            <div class="brand-icon-box">
                <i class="bi bi-code-slash"></i>
            </div>
            @endif
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 shadow-none text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل القائمة">
            <i class="bi bi-list fs-1"></i>
        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-1">
                @if($company->show_hero_section ?? true)
                <li class="nav-item">
                    <a class="nav-link active" href="#hero">الرئيسية</a>
                </li>
                @endif
                @if($company->show_about_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#about">من نحن</a>
                </li>
                @endif
                @if($company->show_services_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#services">خدماتنا</a>
                </li>
                @endif
                @if($company->show_projects_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#projects">اعمالنا</a>
                </li>
                @endif
                @if($company->show_testimonials_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">آراء العملاء</a>
                </li>
                @endif
                @if($company->show_partners_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#partners">شركاء النجاح</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#faq">الأسئلة الشائعة</a>
                </li>
                @if($company->show_contact_section ?? true)
                <li class="nav-item">
                    <a class="nav-link" href="#contact">اتصل بنا</a>
                </li>
                @endif
            </ul>

            <!-- Navbar Actions -->
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <!-- Dark Mode Toggle Button -->
                <button type="button" class="theme-toggle-btn" id="themeToggleBtn" title="تغيير المظهر" aria-label="تغيير المظهر">
                    <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                </button>

                @if($company->show_contact_section ?? true)
                <!-- CTA Button -->
                <a href="#contact" class="btn btn-custom-primary">
                    <i class="bi bi-rocket-takeoff-fill ms-1"></i>
                    <span>ابدأ مشروعك</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>