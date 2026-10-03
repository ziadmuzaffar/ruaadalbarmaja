<!-- Admin Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Sidebar Header / Logo -->
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="brand-logo-glow">
                <img src="{{ asset('public/storage/' . $companyInfo->logo) }}" alt="رواد البرمجة" class="brand-logo-img">
            </div>
            <div class="brand-text">
                <span class="brand-name">رواد البرمجة</span>
                <span class="brand-sub">لوحة التحكم الإدارية</span>
            </div>
        </a>
        <button class="btn-close-sidebar d-lg-none" id="closeSidebarBtn" type="button" aria-label="إغلاق القائمة">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-body">
        <!-- Main Navigation Group -->
        <ul class="sidebar-nav mb-3">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie nav-icon"></i>
                    <span class="nav-text">لوحة التحكم</span>
                </a>
            </li>
        </ul>

        @php
        $isContentActive = request()->routeIs('admin.services.*', 'admin.categories.*', 'admin.projects.*', 'admin.partners.*', 'admin.testimonials.*', 'admin.statistics.*');
        @endphp

        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link nav-dropdown-toggle {{ $isContentActive ? 'active' : '' }}"
                    data-bs-toggle="collapse"
                    href="#contentMgmtSubmenu"
                    role="button"
                    aria-expanded="{{ $isContentActive ? 'true' : 'false' }}"
                    aria-controls="contentMgmtSubmenu">
                    <i class="fas fa-layer-group nav-icon"></i>
                    <span class="nav-text">إدارة المحتوى</span>
                    <i class="fas fa-chevron-down submenu-arrow ms-auto"></i>
                </a>
                <div class="collapse {{ $isContentActive ? 'show' : '' }}" id="contentMgmtSubmenu">
                    <ul class="sidebar-submenu">
                        <li class="submenu-item">
                            <a href="{{ route('admin.services.index') }}" class="submenu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                                <i class="fas fa-concierge-bell submenu-icon"></i>
                                <span class="submenu-text">الخدمات</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('admin.categories.index') }}" class="submenu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                <i class="fas fa-tags submenu-icon"></i>
                                <span class="submenu-text">التصنيفات</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('admin.projects.index') }}" class="submenu-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                                <i class="fas fa-briefcase submenu-icon"></i>
                                <span class="submenu-text">المشاريع</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('admin.partners.index') }}" class="submenu-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                                <i class="fas fa-handshake submenu-icon"></i>
                                <span class="submenu-text">الشركاء</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('admin.testimonials.index') }}" class="submenu-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                                <i class="fas fa-quote-right submenu-icon"></i>
                                <span class="submenu-text">آراء العملاء</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{ route('admin.statistics.index') }}" class="submenu-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                                <i class="fas fa-chart-bar submenu-icon"></i>
                                <span class="submenu-text">الإحصائيات</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <!-- Messages & Inquiries -->
        <ul class="sidebar-nav mb-3">
            <li class="nav-item">
                <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope-open-text nav-icon"></i>
                    <span class="nav-text">رسائل التواصل</span>
                    @if(($unreadNotificationsCount ?? 0) > 0)
                    <span class="badge bg-danger rounded-pill ms-auto px-2 py-0.5 fs-11">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <!-- Settings & Company Info -->
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('admin.company-info.edit') }}" class="nav-link {{ request()->routeIs('admin.company-info.*', 'admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-sliders nav-icon"></i>
                    <span class="nav-text">إعدادات الموقع والصيانة</span>
                    @if(isset($companyInfo) && $companyInfo->is_maintenance)
                    <span class="badge bg-warning text-dark rounded-pill ms-auto px-2 py-0.5 fs-11">صيانة</span>
                    @endif
                </a>
            </li>
        </ul>

    </div>
</aside>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>