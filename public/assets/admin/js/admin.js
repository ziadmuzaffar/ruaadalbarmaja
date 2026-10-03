/**
 * Admin Panel Custom Scripts (jQuery Powered)
 */
$(document).ready(function() {
    // 1. Setup CSRF token for all jQuery AJAX requests automatically
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    }

    // 2. Global Tooltips & Popovers Initialization
    if (typeof bootstrap !== 'undefined') {
        $('[data-bs-toggle="tooltip"]').each(function() {
            new bootstrap.Tooltip(this);
        });

        $('[data-bs-toggle="popover"]').each(function() {
            new bootstrap.Popover(this);
        });
    }

    // 3. Smooth Fade Out for Alert Messages
    $('.alert-dismissible').delay(5000).fadeOut(400);

    // 4. Sidebar Mobile & Desktop Toggle Handler with Persistence & Debouncing
    function applySidebarState() {
        if ($(window).width() >= 992) {
            const isCollapsed = localStorage.getItem('admin_sidebar_collapsed') === 'true';
            if (isCollapsed) {
                $('.admin-wrapper, #adminWrapper').addClass('sidebar-collapsed');
            } else {
                $('.admin-wrapper, #adminWrapper').removeClass('sidebar-collapsed');
            }
        }
    }

    applySidebarState();

    let lastSidebarToggleTime = 0;
    window.performSidebarToggle = function(e) {
        if (e && e.preventDefault) e.preventDefault();
        
        const now = Date.now();
        if (now - lastSidebarToggleTime < 350) {
            return; // Ignore duplicate calls within 350ms
        }
        lastSidebarToggleTime = now;

        const $adminWrapper = $('.admin-wrapper, #adminWrapper');
        const $adminSidebar = $('.admin-sidebar, #adminSidebar');
        const $sidebarBackdrop = $('.sidebar-backdrop, #sidebarBackdrop');

        if ($(window).width() >= 992) {
            $adminWrapper.toggleClass('sidebar-collapsed');
            const isNowCollapsed = $adminWrapper.hasClass('sidebar-collapsed');
            localStorage.setItem('admin_sidebar_collapsed', isNowCollapsed ? 'true' : 'false');
        } else {
            $adminSidebar.toggleClass('show');
            $sidebarBackdrop.toggleClass('show');
        }

        if (typeof window.syncSidebarIcon === 'function') {
            window.syncSidebarIcon();
        }
    };

    $(document).off('click', '#toggleSidebarBtn').on('click', '#toggleSidebarBtn', function(e) {
        window.performSidebarToggle(e);
    });

    $(document).off('click', '#closeSidebarBtn, #sidebarBackdrop').on('click', '#closeSidebarBtn, #sidebarBackdrop', function(e) {
        if (e && e.preventDefault) e.preventDefault();
        $('.admin-sidebar, #adminSidebar').removeClass('show');
        $('.sidebar-backdrop, #sidebarBackdrop').removeClass('show');
    });

    // 5. Global Search Shortcut (Ctrl + K / Cmd + K)
    $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            $('.header-search-input').trigger('focus');
        }
    });
});
