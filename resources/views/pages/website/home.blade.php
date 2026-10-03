@extends('layouts.website.app')

@section('title', ($company->name ?? 'رواد البرمجة') . ' | أفضل شركة برمجة وتطوير مواقع وتطبيقات في السعودية')
@section('meta_description', 'شركة رواد البرمجة: شريكك التقني لتطوير المواقع والمتاجر الإلكترونية، وبرمجة تطبيقات الهواتف الذكية وحلول الذكاء الاصطناعي في الرياض والمملكة العربية السعودية.')

@section('content')
@if($company->show_hero_section ?? true)
<!-- ==========================================
     1. Hero Section
     ========================================== -->
<section class="hero-section" id="hero">
    <div class="hero-bg-shapes">
        <div class="shape-glow-1"></div>
        <div class="shape-glow-2"></div>
    </div>
    <div class="container position-relative z-2">
        <div class="row justify-content-center">
            <!-- Hero Text Content -->
            <div class="col-lg-10 col-xl-8 text-center">
                <div class="hero-badge animate__animated animate__fadeInDown">
                    <i class="bi bi-stars text-warning fs-5"></i>
                    <span>الرائدون في التميز البرمجي والحلول الذكية</span>
                </div>
                <h1 class="hero-title animate__animated animate__fadeInUp">
                    نصنع المستقبل الرقمي <span>لشركتك</span> بأعلى جودة وإتقان
                </h1>
                <p class="hero-text mx-auto animate__animated animate__fadeInUp animate__delay-1s">
                    {{ $company->description ?? 'شركة متخصصة في ابتكار وتطوير الحلول الرقمية، وتصميم المواقع والتطبيقات.' }}
                </p>
                <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                    @if($company->show_contact_section ?? true)
                    <a href="#contact" class="btn btn-custom-primary btn-lg fs-6">
                        <span>ابدأ مشروعك الآن</span>
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    @endif
                    @if($company->show_projects_section ?? true)
                    <a href="#projects" class="btn btn-custom-outline text-white border-light btn-lg fs-6">
                        <i class="bi bi-grid-fill me-1"></i>
                        <span>استكشف أعمالنا</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($company->show_about_section ?? true)
<!-- ==========================================
     2. About Us Section
     ========================================== -->
<section class="section-padding bg-body" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- About Visual Card -->
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="rounded-4 overflow-hidden shadow-lg border border-light">
                        <img src="{{ asset('public/storage/about-us.avif') }}" alt="شركة {{ $company->name ?? 'رواد البرمجة' }} - رواد حلول البرمجة وتطوير المواقع والتطبيقات الذكية" class="img-fluid w-100 object-fit-cover" style="min-height: 380px;" loading="lazy" decoding="async">
                    </div>
                    @if(!empty($company->founded_year))
                    <div class="position-absolute bottom-0 end-0 m-4 p-4 rounded-4 text-white shadow-lg glass-panel text-end border-primary" style="background: var(--gradient-primary); max-width: 260px;">
                        <h3 class="fw-bold mb-1 display-5">{{ date('Y') - $company->founded_year + 1 }}+</h3>
                        <p class="mb-0 font-weight-bold">سنوات من الخبرة والتميز والابتكار البرمجي</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- About Content -->
            <div class="col-lg-6">
                <div class="section-title-wrapper text-start mb-4">
                    <div class="section-subtitle">
                        <i class="bi bi-building"></i>
                        <span>من نحن</span>
                    </div>
                    <h2 class="section-title">شريكك التكنولوجي الموثوق لتحقيق النجاح الرقمي</h2>
                </div>
                <p class="text-secondary lead fs-6 mb-4">
                    {{ $company->about ?? 'شركة رواد البرمجة هي مؤسسة رائدة في تقديم الحلول البرمجية المتكاملة والاستشارات التقنية.' }}
                </p>

                <!-- 4 Key Advantages -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-body-tertiary border">
                            <i class="bi bi-lightning-charge-fill text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0">سرعة ودقة الإنجاز</h6>
                                <small class="text-muted">تسليم المشاريع في الموعد</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-body-tertiary border">
                            <i class="bi bi-people-fill text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0">خبراء متميزون</h6>
                                <small class="text-muted">فريق مهندسين ومطورين</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-body-tertiary border">
                            <i class="bi bi-cpu-fill text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0">تقنيات حديثة</h6>
                                <small class="text-muted">أحدث أدوات وأطر العمل</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-body-tertiary border">
                            <i class="bi bi-headset text-primary fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0">دعم فني متواصل</h6>
                                <small class="text-muted">متابعة وصيانة مستمرة</small>
                            </div>
                        </div>
                    </div>
                </div>

                @if($company->show_services_section ?? true)
                <a href="#services" class="btn btn-custom-outline">
                    <span>تعرف على جميع خدماتنا</span>
                    <i class="bi bi-arrow-left"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if($company->show_services_section ?? true)
<!-- ==========================================
     3. Services Section
     ========================================== -->
<section class="section-padding bg-body-tertiary" id="services">
    <div class="container">
        <div class="section-title-wrapper text-center">
            <div class="section-subtitle">
                <i class="bi bi-layers-fill"></i>
                <span>خدماتنا المتميزة</span>
            </div>
            <h2 class="section-title">حلول رقمية متكاملة مصممة لنمو وتطوير أعمالك</h2>
            <p class="section-description">نقدم باقة واسعة من الخدمات البرمجية التي تغطي كافة متطلبات التحول الرقمي وفق أحدث المعايير العالمية.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="{{ $service->icon ?? 'bi bi-code-square' }}"></i>
                    </div>
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p class="service-description">{{ $service->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-lg-8 text-center py-4">
                <div class="p-4 rounded-4 bg-body border border-dashed text-center shadow-sm">
                    <i class="bi bi-layers text-primary fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold text-body mb-2">لا تتوفر خدمات حالياً</h5>
                    <p class="text-muted mb-0 fs-14">نسعى دائماً لتقديم أفضل الحلول الرقمية، وسيتم إضافة قائمة خدماتنا المتميزة قريباً.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endif

@if($company->show_statistics_section ?? true)
<!-- ==========================================
     4. Statistics Section
     ========================================== -->
<section class="stats-section section-padding" id="statistics">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @forelse($statistics as $stat)
            <div class="col-lg-3 col-md-6">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="{{ $stat->icon ?? 'bi bi-graph-up' }}"></i>
                    </div>
                    <div class="stat-number" data-target="{{ $stat->display_value }}">
                        {{ $stat->display_value }}
                    </div>
                    <div class="stat-label">{{ $stat->title }}</div>
                </div>
            </div>
            @empty
            <div class="col-lg-8 text-center py-4">
                <div class="p-4 rounded-4 glass-panel border border-white border-opacity-20 text-center shadow-sm text-white">
                    <i class="bi bi-bar-chart-line fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold text-white mb-2">لا تتوفر إحصائيات حالياً</h5>
                    <p class="text-white-50 mb-0 fs-14">جاري العمل على تحديث إحصائيات وأرقام الإنجاز لشركتنا.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endif

@if($company->show_projects_section ?? true)
<!-- ==========================================
     5. Projects Portfolio Section
     ========================================== -->
<section class="section-padding bg-body" id="projects">
    <div class="container">
        <div class="section-title-wrapper text-center">
            <div class="section-subtitle">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <span>معرض الأعمال</span>
            </div>
            <h2 class="section-title">مشاريع نعتز بإنجازها وتتحدث عن ابتكارنا</h2>
            <p class="section-description">استكشف نماذج من أحدث المشروعات والحلول الرقمية التي قمنا بتطويرها لعملائنا في مختلف القطاعات.</p>
        </div>

        <!-- Filter Buttons -->
        @if($categories->count() > 0 && $projects->count() > 0)
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            <button class="portfolio-filter-btn active" data-filter="all">الكل</button>
            @foreach($categories as $category)
            <button class="portfolio-filter-btn" data-filter="{{ $category->id }}">{{ $category->name }}</button>
            @endforeach
        </div>
        @endif

        <!-- Projects Grid -->
        <div class="row g-4 justify-content-center">
            @forelse($projects as $project)
            <div class="col-lg-4 col-md-6 project-item" data-category="{{ $project->category_id }}">
                <div class="project-card">
                    <div class="project-img-wrapper">
                        @if(!empty($project->image))
                        <img src="{{ asset('public/storage/' . $project->image) }}" alt="مشروع {{ $project->title }} - من أعمال {{ $company->name ?? 'رواد البرمجة' }}" loading="lazy" decoding="async">
                        @endif
                        @if($project->category)
                        <span class="project-badge">{{ $project->category->name }}</span>
                        @endif
                    </div>
                    <div class="project-body">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-description">{{ Str::limit($project->description, 110) }}</p>
                        <div class="project-meta">
                            @if($project->client_name)
                            <span><i class="bi bi-person me-1"></i> {{ $project->client_name }}</span>
                            @endif
                            @if($project->completion_date)
                            <span><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($project->completion_date)->format('Y') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-8 text-center py-4">
                <div class="p-4 rounded-4 bg-body-tertiary border border-dashed text-center shadow-sm">
                    <i class="bi bi-briefcase text-primary fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold text-body mb-2">لا تتوفر مشاريع حالياً</h5>
                    <p class="text-muted mb-0 fs-14">قريباً سنقوم بنشر وأتمتة نماذج من أحدث مشاريعنا وأعمالنا المتميزة.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endif

@if($company->show_testimonials_section ?? true)
<!-- ==========================================
     6. Testimonials Section
     ========================================== -->
<section class="section-padding bg-body-tertiary" id="testimonials">
    <div class="container">
        <div class="section-title-wrapper text-center">
            <div class="section-subtitle">
                <i class="bi bi-chat-square-quote-fill"></i>
                <span>آراء العملاء</span>
            </div>
            <h2 class="section-title">ماذا يقول عملاؤنا عن تجربتهم معنا</h2>
            <p class="section-description">نفخر بثقة عملائنا وشراكاتنا المستمرة معهم لتقديم أفضل الخدمات البرمجية.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="bi bi-quote"></i></div>
                    <div class="testimonial-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill {{ $i <= ($testimonial->rating ?? 5) ? '' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                    <p class="testimonial-text">"{{ $testimonial->testimonial }}"</p>
                    <div class="client-info">
                        @if(!empty($testimonial->client_image))
                        <img src="{{ asset('public/storage/' . $testimonial->client_image) }}" alt="صورة العميل {{ $testimonial->client_name }}" class="client-avatar" loading="lazy" decoding="async">
                        @else
                        <div class="client-avatar bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-5">
                            {{ mb_substr($testimonial->client_name, 0, 1) }}
                        </div>
                        @endif
                        <div>
                            <h6 class="client-name">{{ $testimonial->client_name }}</h6>
                            <p class="client-role">{{ $testimonial->client_position }} {{ $testimonial->client_company ? '- ' . $testimonial->client_company : '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-8 text-center py-4">
                <div class="p-4 rounded-4 bg-body border border-dashed text-center shadow-sm">
                    <i class="bi bi-chat-square-quote text-primary fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold text-body mb-2">لا تتوفر آراء عملاء حالياً</h5>
                    <p class="text-muted mb-0 fs-14">سيتم مشاركة تقييمات وآراء شركائنا وعملائنا الكرام قريباً.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endif

@if($company->show_partners_section ?? true)
<!-- ==========================================
     7. Partners Section
     ========================================== -->
<section class="section-padding bg-body" id="partners">
    <div class="container">
        <div class="section-title-wrapper text-center mb-5">
            <div class="section-subtitle">
                <i class="bi bi-handbag-fill"></i>
                <span>شركاء النجاح</span>
            </div>
            <h2 class="section-title">نعتز بثقة كبرى الشركات والمؤسسات</h2>
        </div>

        @if($partners->count() > 0)
        <div class="partners-slider-wrapper position-relative">
            <div class="swiper partners-swiper">
                <div class="swiper-wrapper align-items-center">
                    @foreach($partners as $partner)
                    <div class="swiper-slide">
                        <a href="{{ $partner->website ?? '#' }}" target="_blank" class="partner-logo-item" title="{{ $partner->name }}">
                            @if(!empty($partner->image))
                            <img src="{{ asset('public/storage/' . $partner->image) }}" alt="شعار شريك النجاح {{ $partner->name }}" loading="lazy" decoding="async">
                            @else
                            <span class="fw-bold text-secondary text-truncate">{{ $partner->name }}</span>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center py-4">
                <div class="p-4 rounded-4 bg-body-tertiary border border-dashed text-center shadow-sm">
                    <i class="bi bi-handbag text-primary fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold text-body mb-2">لا يوجد شركاء نجاح مضافين حالياً</h5>
                    <p class="text-muted mb-0 fs-14">سيتم استعراض قائمة شركاء وشركات النجاح قريباً.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endif

<!-- ==========================================
     8. FAQ Section (الأسئلة الشائعة & SEO)
     ========================================== -->
<section class="section-padding bg-body" id="faq">
    <div class="container">
        <div class="section-title-wrapper text-center">
            <div class="section-subtitle">
                <i class="bi bi-question-circle-fill"></i>
                <span>الأسئلة الأكثر شيوعاً</span>
            </div>
            <h2 class="section-title">إجابات شاملة عن استفساراتك حول البرمجة والحلول الرقمية</h2>
            <p class="section-description">جمعنا لك أبرز الأسئلة المتكررة التي يطرحها عملاؤنا لمساعدتك على اتخاذ القرار الأنسب لمشروعك.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <!-- Q1 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                <i class="bi bi-patch-question-fill text-primary me-2"></i>
                                ما هي الخدمات البرمجية التي تقدمها شركة رواد البرمجة؟
                            </button>
                        </h3>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                نقدم منظومة برمجية متكاملة تغطي كافة احتياجات التحول الرقمي للشركات والمؤسسات، وتشمل: تصميم وتطوير المواقع والمتاجر الإلكترونية المتوافقة مع محركات البحث (SEO)، برمجة تطبيقات الهواتف الذكية (iOS و Android)، أنظمة إدارة الموارد والشركات السحابية (ERP & CRM)، حلول الذكاء الاصطناعي وأتمتة العمليات، بالإضافة للاستشارات التقنية وخدمات الأمن السيبراني.
                            </div>
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                <i class="bi bi-clock-history text-primary me-2"></i>
                                كم يستغرق وقت تنفيذ وتطوير الموقع أو التطبيق؟
                            </button>
                        </h3>
                        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                تعتمد مدة الإنجاز على حجم المشروع ونطاق المزايا المطلوبة. عادةً ما تستغرق المواقع التعريفية والشركات من 7 إلى 14 يوم عمل، بينما تتراوح مدة تطوير المتاجر الإلكترونية والتطبيقات المتوسطة والكبيرة بين 3 إلى 8 أسابيع، مع التزام تام بالخطة الزمنية وتسليم المشروع بأعلى معايير الجودة.
                            </div>
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                <i class="bi bi-search text-primary me-2"></i>
                                هل المواقع والتطبيقات مهيأة لمحركات البحث (SEO) وسريعة التجاوب؟
                            </button>
                        </h3>
                        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                نعم بالتأكيد، كافة برمجياتنا تُبنى وفق أحدث متطلبات ومعايير محركات البحث (SEO)، بما يشمل البيانات المنظمة (Schema.org)، سرعة التحميل الفائقة، تحسين تجربة المستخدم (Core Web Vitals)، والتوافق التام مع كافة الشاشات والأجهزة الذكية لتتصدر نتائج بحث Google.
                            </div>
                        </div>
                    </div>

                    <!-- Q4 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                هل تقدمون خدمات الدعم الفني والصيانة بعد تسليم المشروع؟
                            </button>
                        </h3>
                        <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                نعم، نحن نعتبر أنفسنا شريكاً تقنياً مستمراً لأعمالك. نوفر فترة ضمان مجانية مع كافة المشاريع بالإضافة لعقود دعم فني وصيانة دورية مستمرة، تحديثات أمنية، ونسخ احتياطي لحماية بياناتك وضمان استقرار أداء المنصة على مدار الساعة.
                            </div>
                        </div>
                    </div>

                    <!-- Q5 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                <i class="bi bi-wallet2 text-primary me-2"></i>
                                كيف يتم تحديد تكلفة المشروع وما هي خيارات الدفع؟
                            </button>
                        </h3>
                        <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                يتم تسعير المشروع بناءً على الخصائص والمواصفات الفنية المحددة بدقة، ونقدم أسعاراً تنافسية تناسب تطلعاتكم وميزانياتكم. كما نتيح خطط سداد ميسرة مقسمة على مراحل التنفيذ (دفعة بدء، دفعة اعتماد التصميم والبرمجة، ودفعة نهائية عند التسليم والإطلاق).
                            </div>
                        </div>
                    </div>

                    <!-- Q6 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="faqHeading6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                                <i class="bi bi-rocket-takeoff text-primary me-2"></i>
                                كيف أبدأ مشروعي مع رواد البرمجة؟
                            </button>
                        </h3>
                        <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                يمكنك بدء رحلتك بالضغط على زر "ابدأ مشروعك" أو تعبئة نموذج التواصل أدناه أو مراسلتنا مباشرة عبر الواتساب. سيتواصل معك أحد مستشارينا التقنيين خلال وقت قياسي لفهم متطلباتك وتقديم استشارة تقنية مجانية وعرض فني ومالي مفصل.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($company->show_contact_section ?? true)
<!-- ==========================================
     8. Contact Us Section
     ========================================== -->
<section class="section-padding bg-body-tertiary" id="contact">
    <div class="container">
        <div class="section-title-wrapper text-center">
            <div class="section-subtitle">
                <i class="bi bi-envelope-open-fill"></i>
                <span>تواصل معنا</span>
            </div>
            <h2 class="section-title">هل لديك مشروع جديد؟ يسعدنا التحدث معك</h2>
            <p class="section-description">اترك رسالتك وسيتواصل معك فريق الاستشارين والمطورين لمناقشة كافة التفاصيل وتحقيق أهدافك.</p>
        </div>

        <div class="row g-4 align-items-stretch">
            <!-- Contact Info Panel -->
            <div class="col-lg-5">
                <div class="contact-card-info d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold text-white mb-4">معلومات الاتصال</h3>
                        <p class="text-white-50 mb-5">يسعدنا استقبال استفساراتك واستشاراتك البرمجية طوال أيام الأسبوع.</p>

                        @if(!empty($company->phone))
                        <div class="info-item">
                            <div class="info-icon-box"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h6 class="text-white fw-bold mb-1">الهاتف المباشر</h6>
                                <p class="mb-0 text-white-50" dir="ltr">{{ $company->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($company->whatsapp))
                        <div class="info-item">
                            <div class="info-icon-box"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <h6 class="text-white fw-bold mb-1">واتساب المباشر</h6>
                                <p class="mb-0 text-white-50" dir="ltr">+{{ $company->whatsapp }}</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($company->email))
                        <div class="info-item">
                            <div class="info-icon-box"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h6 class="text-white fw-bold mb-1">البريد الإلكتروني</h6>
                                <p class="mb-0 text-white-50">{{ $company->email }}</p>
                            </div>
                        </div>
                        @endif

                        @if(!empty($company->address))
                        <div class="info-item">
                            <div class="info-icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h6 class="text-white fw-bold mb-1">العنوان الرئيسي</h6>
                                <p class="mb-0 text-white-50">{{ $company->address }} {{ $company->city ? '- ' . $company->city : '' }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if(!empty($company->working_hours))
                    <div class="pt-4 border-top border-white border-opacity-10">
                        <small class="text-white-50"><i class="bi bi-clock-fill me-1"></i> أوقات العمل الرسمية: {{ $company->working_hours }}</small>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form Panel -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 class="fw-bold mb-4">أرسل لنا رسالة</h3>
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        {{-- Anti-Spam Honeypot Field --}}
                        <div style="display:none !important;" aria-hidden="true">
                            <input type="text" name="_hp_website" tabindex="-1" autocomplete="off" value="">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">الاسم الكامل <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control form-control-custom" placeholder="أدخل اسمك الكامل" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">البريد الإلكتروني <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control form-control-custom" placeholder="name@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">رقم الهاتف / الجوال</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-custom" placeholder="05XXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label fw-bold">موضوع الرسالة <span class="text-danger">*</span></label>
                                <input type="text" name="subject" id="subject" class="form-control form-control-custom" placeholder="مثال: طلب تطوير موقع إلكتروني" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-bold">تفاصيل الرسالة <span class="text-danger">*</span></label>
                                <textarea name="message" id="message" rows="5" class="form-control form-control-custom" placeholder="اكتب التفاصيل المتوفرة لديك عن مشروعك..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-custom-primary btn-lg w-100 justify-content-center">
                                    <i class="bi bi-send-fill ms-2"></i>
                                    <span>إرسال الرسالة الآن</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<!-- Swiper CSS for Partners Slider -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@push('scripts')
<!-- Swiper JS for Partners Slider -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.partners-swiper', {
                slidesPerView: 2,
                spaceBetween: 16,
                loop: true,
                grabCursor: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                speed: 700,
                breakpoints: {
                    576: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 24,
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 28,
                    }
                }
            });
        }
    });
</script>
@endpush

@push('seo_schema')
@php
    $servicesList = [];
    foreach ($services as $index => $service) {
        $servicesList[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $service->title,
            'description' => Str::limit(strip_tags($service->description), 150),
        ];
    }

    $servicesSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'قائمة خدمات شركة ' . ($company->name ?? 'رواد البرمجة'),
        'description' => 'خدمات البرمجة والحلول التقنية المتكاملة',
        'itemListElement' => $servicesList,
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name' => 'ما هي الخدمات البرمجية التي تقدمها شركة رواد البرمجة؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'نقدم منظومة برمجية متكاملة تشمل برمجة وتصميم المواقع والمتاجر الإلكترونية، تطوير تطبيقات الهواتف الذكية (iOS و Android)، الأنظمة السحابية وإدارة المؤسسات (ERP & CRM)، وحلول الذكاء الاصطناعي والأمن السيبراني.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'كم يستغرق وقت تطوير وتصميم الموقع أو التطبيق؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'تعتمد المدة على حجم المشروع ومتطلباته الفنية؛ فالمواقع التعريفية تستغرق عادة من 7 إلى 14 يوم عمل، بينما المتاجر والتطبيقات المتكاملة تتراوح مدة تنفيذها بين 3 إلى 8 أسابيع مع التزام تام بمواعيد التسليم.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'هل المواقع والتطبيقات مهيأة لمحركات البحث (SEO) وسريعة التجاوب؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'نعم، نطبق أفضل ممارسات السيو (SEO) الفنية والتقنية لضمان تصدر موقعك نتائج البحث في Google، مع سرعة استجابة فائقة وتوافق كامل مع كافة الأجهزة وشاشات الجوال.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'هل تقدمون خدمات الدعم الفني والصيانة بعد تسليم المشروع؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'نعم، نوفر عقود دعم فني وصيانة دورية وضماناً شاملاً بعد الإطلاق لضمان استمرارية وكفاءة عمل مشروعك الرقمي وحمايته على مدار الساعة.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'كيف يتم تحديد تكلفة المشروع وطرق الدفع؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'يتم احتساب التكلفة بناءً على الميزات والوظائف المطلوبة في كراسة الشروط، ونقدم خطط دفع مرنة وميسرة مقسمة على مراحل تسليم المشروع لراحة العميل.',
                ],
            ],
            [
                '@type' => 'Question',
                'name' => 'كيف أبدأ مشروعي مع رواد البرمجة؟',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'يمكنك بدء رحلتك بالضغط على زر ابدأ مشروعك أو تعبئة نموذج التواصل أو مراسلتنا مباشرة عبر الواتساب لتحديد موعد جلسة استشارية مجانية.',
                ],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($servicesSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endpush