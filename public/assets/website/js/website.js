/**
 * رواد البرمجة - Public Website Interactive Scripts
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Theme Management (Dark / Light Mode Toggle)
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');
    
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            if (themeIcon) {
                themeIcon.className = 'bi bi-sun-fill text-warning';
            }
        } else {
            document.body.classList.remove('dark-mode');
            if (themeIcon) {
                themeIcon.className = 'bi bi-moon-stars-fill';
            }
        }
        localStorage.setItem('website_theme', theme);
    }

    // Initialize saved theme
    const savedTheme = localStorage.getItem('website_theme') || 'light';
    applyTheme(savedTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
        });
    }

    // 2. Navbar Scroll Behavior
    const navbar = document.querySelector('.navbar-custom');
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // 3. Smooth Scroll for Nav Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    
                    // Collapse mobile menu if open
                    const navbarCollapse = document.getElementById('navbarNav');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (bsCollapse) bsCollapse.hide();
                    }

                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // 4. Portfolio Filter Buttons
    const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const projectItems = document.querySelectorAll('.project-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Toggle active state
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            projectItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (filterValue === 'all' || itemCategory === filterValue) {
                    item.style.display = 'block';
                    item.classList.add('animate__animated', 'animate__fadeIn');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // 5. Statistics Counter Animation
    const counterElements = document.querySelectorAll('.stat-number');
    let animated = false;

    function animateCounters() {
        if (animated || counterElements.length === 0) return;
        
        const firstCounter = counterElements[0];
        const rect = firstCounter.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (rect.top <= windowHeight && rect.bottom >= 0) {
            animated = true;
            counterElements.forEach(counter => {
                const targetText = counter.getAttribute('data-target') || counter.innerText;
                const numericVal = parseInt(targetText.replace(/\D/g, '')) || 0;
                const suffix = targetText.replace(/[0-9]/g, '');

                if (numericVal === 0) return;

                let count = 0;
                const duration = 2000;
                const increment = numericVal / (duration / 16);

                const updateCount = () => {
                    count += increment;
                    if (count < numericVal) {
                        counter.innerText = Math.ceil(count) + suffix;
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = numericVal + suffix;
                    }
                };
                updateCount();
            });
        }
    }

    window.addEventListener('scroll', animateCounters);
    animateCounters(); // Initial check

    // 6. Contact Form AJAX Submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> جاري الإرسال...';

            const formData = new FormData(contactForm);

            axios.post(contactForm.action, formData)
                .then(function (response) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'تم الإرسال بنجاح!',
                            text: response.data.message || 'شكراً لتواصلك معنا. سنرد عليك في أقرب وقت.',
                            icon: 'success',
                            confirmButtonText: 'حسناً',
                            confirmButtonColor: '#4f46e5'
                        });
                    } else {
                        alert(response.data.message || 'تم إرسال الرسالة بنجاح.');
                    }
                    contactForm.reset();
                })
                .catch(function (error) {
                    let errMsg = 'حدث خطأ أثناء الإرسال. يرجى المحاولة مرة أخرى.';
                    if (error.response && error.response.data && error.response.data.errors) {
                        const errs = Object.values(error.response.data.errors).flat();
                        errMsg = errs.join('\n');
                    } else if (error.response && error.response.data && error.response.data.message) {
                        errMsg = error.response.data.message;
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'تنبيه',
                            text: errMsg,
                            icon: 'error',
                            confirmButtonText: 'موافق',
                            confirmButtonColor: '#ef4444'
                        });
                    } else {
                        alert(errMsg);
                    }
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
        });
    }
});
