<!-- Admin Top Header Navbar -->
<header class="admin-header">
    <div class="header-left d-flex align-items-center gap-3">
        <!-- Sidebar Toggle Mobile & Desktop -->
        <button class="btn-icon-header" id="toggleSidebarBtn" type="button" aria-label="تبديل القائمة الجانبية" title="تبديل القائمة الجانبية">
            <i class="fas fa-bars" id="sidebarToggleIcon"></i>
        </button>

        @if(isset($companyInfo) && $companyInfo->is_maintenance)
        <div class="d-none d-sm-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-danger-subtle text-danger border border-danger-subtle fs-12 fw-bold">
            <span class="spinner-grow spinner-grow-sm text-danger" style="width: 8px; height: 8px;"></span>
            <span>الموقع تحت الصيانة</span>
            <form action="{{ route('admin.company-info.toggle-maintenance') }}" method="POST" class="d-inline ms-1">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm py-0 px-2 rounded-pill fs-11" title="إيقاف وضع الصيانة وإتاحة الموقع للزوار">
                    إيقاف
                </button>
            </form>
        </div>
        @endif
    </div>

    <div class="header-right d-flex align-items-center gap-2 gap-sm-3">
        <!-- View Live Site Link -->
        <a href="/" target="_blank" class="btn-icon-header d-none d-sm-flex" title="زيارة الموقع الرئيسي">
            <i class="fas fa-globe"></i>
        </a>

        <!-- Dark / Light Theme Toggle -->
        <button class="btn-icon-header" id="themeToggleBtn" type="button" title="تغيير المظهر">
            <i class="fas fa-moon" id="themeIcon"></i>
        </button>

        <!-- Notifications Dropdown -->
        @php
        $unreadCount = $unreadNotificationsCount ?? 0;
        $notifications = $headerNotifications ?? collect();
        @endphp
        <div class="dropdown">
            <button class="btn-icon-header position-relative notification-trigger-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="التنبيهات">
                <i class="fas fa-bell"></i>
                @if($unreadCount > 0)
                <span class="notification-badge-pulse"></span>
                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger border border-light notification-badge-count">
                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                    <span class="visually-hidden">{{ $unreadCount }} تنبيهات جديدة</span>
                </span>
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-start notification-dropdown p-0 shadow-lg border-0">
                <!-- Header section -->
                <div class="notification-dropdown-header p-3 border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="header-notif-icon me-1">
                            <i class="fas fa-bell text-primary"></i>
                        </div>
                        <h6 class="mb-0 fw-bold header-notif-title">التنبيهات</h6>
                        @if($unreadCount > 0)
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1 fs-12">{{ $unreadCount }} جديدة</span>
                        @else
                        <span class="badge bg-light text-muted rounded-pill px-2 py-1 fs-12">لا يوجد جديد</span>
                        @endif
                    </div>
                    @if($unreadCount > 0)
                    <form action="{{ route('admin.contact-messages.mark-all-read') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 text-decoration-none text-muted fs-12 hover-primary" title="تحديد الكل كمقروء">
                            <i class="fas fa-check-double me-1 text-primary"></i> تحديد الكل
                        </button>
                    </form>
                    @endif
                </div>

                <!-- Notifications list -->
                <div class="notification-list custom-scrollbar">
                    @forelse($notifications as $notif)
                    @php
                    $isUnread = ($notif->status === 'new' || !$notif->read_at);
                    @endphp
                    <a href="{{ route('admin.contact-messages.show', $notif->id) }}" class="notification-item d-flex align-items-start gap-3 p-3 text-decoration-none border-bottom transition-all {{ $isUnread ? 'unread-item' : 'read-item' }}">
                        <div class="notif-avatar flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center {{ $isUnread ? 'bg-primary-subtle text-primary' : 'bg-light text-secondary' }}">
                            <i class="fas {{ $isUnread ? 'fa-envelope-open-text' : 'fa-envelope' }}"></i>
                        </div>
                        <div class="notif-details flex-grow-1 overflow-hidden">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h6 class="notif-sender text-dark fw-semibold mb-0 text-truncate fs-14">{{ $notif->name }}</h6>
                                <span class="notif-time text-muted fs-12 flex-shrink-0">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '' }}</span>
                            </div>
                            <p class="notif-subject text-muted mb-1 fs-13 text-truncate fw-medium">{{ $notif->subject ?? 'رسالة جديدة' }}</p>
                            <p class="notif-preview text-muted mb-0 fs-12 text-truncate opacity-75">{{ $notif->message }}</p>
                        </div>
                        @if($isUnread)
                        <span class="unread-dot flex-shrink-0"></span>
                        @endif
                    </a>
                    @empty
                    <div class="p-4 text-center text-muted">
                        <div class="empty-notif-icon mb-2">
                            <i class="fas fa-bell-slash text-muted opacity-50 fs-2"></i>
                        </div>
                        <p class="mb-0 fs-14 fw-medium text-dark">لا توجد تنبيهات حالية</p>
                        <small class="text-muted fs-12">ستظهر الرسائل والتنبيهات الجديدة هنا</small>
                    </div>
                    @endforelse
                </div>

                <!-- Footer section -->
                <div class="notification-dropdown-footer p-2 text-center bg-light border-top">
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm text-primary fw-semibold fs-13 text-decoration-none w-100 py-1">
                        عرض جميع الرسائل والتنبيهات <i class="fas fa-arrow-left ms-1 fs-11"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown">
            <button class="btn-user-profile d-flex align-items-center gap-2 border-0 bg-transparent px-2 py-1 rounded-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="header-avatar flex-shrink-0">
                    <span class="avatar-initials bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-14" style="width: 38px; height: 38px;">
                        {{ strtoupper(mb_substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-start user-dropdown p-2 shadow-lg border-0" style="min-width: 230px;">
                <li class="px-3 py-2 border-bottom mb-2 bg-light rounded-2">
                    <div class="fw-bold text-dark fs-14">{{ Auth::user()->name ?? 'الأدمن' }}</div>
                    <div class="text-muted fs-12 text-truncate">{{ Auth::user()->email ?? '' }}</div>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.profile.show') }}">
                        <i class="fas fa-user-gear me-2 text-primary"></i> الملف الشخصي
                    </a>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.company-info.edit') }}">
                        <i class="fas fa-sliders me-2 text-primary"></i> إعدادات الموقع والصيانة
                    </a>
                </li>
                <li>
                    <a class="dropdown-item rounded-2 py-2" href="{{ route('admin.company-info.index') }}">
                        <i class="fas fa-building me-2 text-secondary"></i> تفاصيل الشركة
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider my-2">
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-2 py-2 text-danger w-100 text-start">
                            <i class="fas fa-right-from-bracket me-2"></i> تسجيل الخروج
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. Sidebar Toggle & Persistence Setup ---
        const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
        const sidebarToggleIcon = document.getElementById('sidebarToggleIcon');

        window.syncSidebarIcon = function() {
            const adminWrapper = document.querySelector('.admin-wrapper, #adminWrapper');
            if (adminWrapper && sidebarToggleIcon) {
                if (adminWrapper.classList.contains('sidebar-collapsed')) {
                    sidebarToggleIcon.className = 'fas fa-bars-staggered';
                } else {
                    sidebarToggleIcon.className = 'fas fa-bars';
                }
            }
        };

        if (toggleSidebarBtn) {
            toggleSidebarBtn.addEventListener('click', function(e) {
                if (typeof window.performSidebarToggle === 'function') {
                    window.performSidebarToggle(e);
                }
            });
        }
        window.syncSidebarIcon();

        // --- 2. Theme Toggle Controller ---
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const themeIcon = document.getElementById('themeIcon');

        function updateThemeUI(theme) {
            if (!themeIcon) return;
            if (theme === 'dark') {
                themeIcon.className = 'fas fa-sun';
                if (themeToggleBtn) themeToggleBtn.setAttribute('title', 'تفعيل الوضع الفاتح');
            } else {
                themeIcon.className = 'fas fa-moon';
                if (themeToggleBtn) themeToggleBtn.setAttribute('title', 'تفعيل الوضع الداكن');
            }
        }

        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
        updateThemeUI(currentTheme);

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const activeTheme = document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light';
                const newTheme = activeTheme === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-bs-theme', newTheme);
                if (newTheme === 'dark') {
                    document.documentElement.classList.add('dark-mode');
                } else {
                    document.documentElement.classList.remove('dark-mode');
                }

                localStorage.setItem('admin_theme', newTheme);
                updateThemeUI(newTheme);
            });
        }

        // --- 3. Header Mini-Slider Auto & Manual Carousel Controller ---
        (function initHeaderMiniSlider() {
            const sliderTrack = document.getElementById('headerMiniSliderTrack');
            if (!sliderTrack) return;

            const slides = sliderTrack.querySelectorAll('.mini-slider-item');
            const totalSlides = slides.length;
            if (totalSlides <= 1) return;

            let currentSlideIndex = 0;
            let slideInterval = null;

            function goToSlide(index) {
                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;

                slides.forEach(s => s.classList.remove('active'));
                slides[index].classList.add('active');
                currentSlideIndex = index;
            }

            function startAutoPlay() {
                stopAutoPlay();
                slideInterval = setInterval(function() {
                    goToSlide(currentSlideIndex + 1);
                }, 3800);
            }

            function stopAutoPlay() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                    slideInterval = null;
                }
            }

            const prevBtn = document.getElementById('miniSliderPrev');
            const nextBtn = document.getElementById('miniSliderNext');

            if (prevBtn) {
                prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    goToSlide(currentSlideIndex - 1);
                    startAutoPlay();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    goToSlide(currentSlideIndex + 1);
                    startAutoPlay();
                });
            }

            const miniSliderWrapper = document.querySelector('.header-mini-slider');
            if (miniSliderWrapper) {
                miniSliderWrapper.addEventListener('mouseenter', stopAutoPlay);
                miniSliderWrapper.addEventListener('mouseleave', startAutoPlay);
            }

            startAutoPlay();
        })();
    });
</script>
@endpush