@extends('layouts.admin.app')

@section('title', 'معلومات الشركة - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-4">

            <!-- Flash Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
            @endif

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-building text-primary me-2"></i> معلومات الشركة</h4>
                    <p class="text-muted fs-14 mb-0">عرض وإدارة هوية الشركة، بيانات التواصل، وعناوين الفروع</p>
                </div>
                <div class="d-flex flex-wrap gap-2 w-sm-auto justify-content-sm-end">
                    <a href="{{ route('admin.company-info.edit') }}" class="btn btn-primary rounded-3 px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-edit me-2"></i> تعديل بيانات الشركة
                    </a>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="row g-4 mb-4">
                <!-- Main Info Card -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4 text-center">
                            <!-- Logo Preview -->
                            <div class="company-logo-container mb-4 overflow-hidden d-flex justify-content-center">
                                @if($companyInfo->logo)
                                <img src="{{ asset('public/storage/' . $companyInfo->logo) }}" alt="{{ $companyInfo->name }}" class="rounded-4 p-2 border shadow-sm" style="max-height: 110px; object-fit: contain;">
                                @else
                                <div class="avatar-large bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold fs-1 shadow" style="width: 100px; height: 100px;">
                                    <i class="fas fa-building fs-1"></i>
                                </div>
                                @endif
                            </div>

                            <h4 class="fw-bold text-dark mb-2">{{ $companyInfo->name }}</h4>
                            <p class="text-muted fs-14 mb-3">{{ $companyInfo->description }}</p>

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fs-13">
                                    <i class="fas fa-calendar-check me-1"></i> تأسست عام {{ $companyInfo->founded_year }}
                                </span>
                                @if($companyInfo->is_active)
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-13">
                                    <i class="fas fa-check-circle me-1"></i> مفعلة
                                </span>
                                @else
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fs-13">
                                    <i class="fas fa-times-circle me-1"></i> معطلة
                                </span>
                                @endif
                            </div>

                            <!-- Social Links -->
                            <div class="d-flex justify-content-center gap-2 mt-4 pt-3 border-top">
                                @if($companyInfo->facebook_url)
                                <a href="{{ $companyInfo->facebook_url }}" target="_blank" class="btn btn-light rounded-circle text-primary shadow-sm" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($companyInfo->twitter_url)
                                <a href="{{ $companyInfo->twitter_url }}" target="_blank" class="btn btn-light rounded-circle text-info shadow-sm" title="Twitter"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($companyInfo->linkedin_url)
                                <a href="{{ $companyInfo->linkedin_url }}" target="_blank" class="btn btn-light rounded-circle text-primary shadow-sm" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if($companyInfo->instagram_url)
                                <a href="{{ $companyInfo->instagram_url }}" target="_blank" class="btn btn-light rounded-circle text-danger shadow-sm" title="Instagram"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($companyInfo->tiktok_url)
                                <a href="{{ $companyInfo->tiktok_url }}" target="_blank" class="btn btn-light rounded-circle text-dark shadow-sm" title="TikTok"><i class="fab fa-tiktok"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comprehensive Data Card -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-info-circle text-primary me-2"></i> التفاصيل وبيانات التواصل</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-envelope text-primary me-1"></i> البريد الإلكتروني</small>
                                        <a href="mailto:{{ $companyInfo->email }}" class="fw-bold text-primary text-decoration-none fs-15">{{ $companyInfo->email }}</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-phone text-primary me-1"></i> رقم الهاتف</small>
                                        <span class="fw-bold text-dark fs-15 dir-ltr d-inline-block">{{ $companyInfo->phone }}</span>
                                    </div>
                                </div>
                                @if($companyInfo->whatsapp)
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fab fa-whatsapp text-success me-1"></i> الواتساب</small>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companyInfo->whatsapp) }}" target="_blank" class="fw-bold text-success text-decoration-none fs-15 dir-ltr d-inline-block">{{ $companyInfo->whatsapp }}</a>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-city text-primary me-1"></i> المدينة</small>
                                        <span class="fw-bold text-dark fs-15">{{ $companyInfo->city }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-map-marker-alt text-primary me-1"></i> الحي</small>
                                        <span class="fw-bold text-dark fs-15">{{ $companyInfo->district }}</span>
                                    </div>
                                </div>
                                @if($companyInfo->street)
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-road text-primary me-1"></i> الشارع</small>
                                        <span class="fw-bold text-dark fs-15">{{ $companyInfo->street }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-location-arrow text-primary me-1"></i> العنوان التفصيلي</small>
                                        <span class="fw-bold text-dark fs-15">{{ $companyInfo->address }}</span>
                                    </div>
                                </div>
                                @if($companyInfo->working_hours)
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 h-100">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-clock text-primary me-1"></i> أوقات العمل الرسمية</small>
                                        <span class="fw-bold text-dark fs-15">{{ $companyInfo->working_hours }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="col-12">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-file-alt text-primary me-1"></i> نبذة عن الشركة</small>
                                        <p class="fw-medium text-dark fs-15 mb-0 leading-relaxed">{{ $companyInfo->about }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sections Visibility Status Card -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-layer-group text-primary me-2"></i> حالة ظهور أقسام الصفحة الرئيسية</h5>
                            <a href="{{ route('admin.company-info.edit') }}" class="btn btn-sm btn-outline-primary rounded-3 px-3 fw-bold">
                                <i class="fas fa-sliders-h me-1"></i> تعديل ظهور الأقسام
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-star text-warning me-2"></i> قسم البداية (Hero)</span>
                                        @if($companyInfo->show_hero_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-info-circle text-primary me-2"></i> قسم من نحن</span>
                                        @if($companyInfo->show_about_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-concierge-bell text-success me-2"></i> قسم الخدمات</span>
                                        @if($companyInfo->show_services_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-chart-bar text-info me-2"></i> قسم الإحصائيات</span>
                                        @if($companyInfo->show_statistics_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-briefcase text-primary me-2"></i> قسم معرض الأعمال</span>
                                        @if($companyInfo->show_projects_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-quote-right text-warning me-2"></i> قسم آراء العملاء</span>
                                        @if($companyInfo->show_testimonials_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-handshake text-secondary me-2"></i> قسم شركاء النجاح</span>
                                        @if($companyInfo->show_partners_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                                        <span class="fw-bold fs-14 text-dark"><i class="fas fa-envelope text-danger me-2"></i> قسم تواصل معنا</span>
                                        @if($companyInfo->show_contact_section ?? true)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye me-1"></i> ظـاهر</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12"><i class="fas fa-eye-slash me-1"></i> مـخفي</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maintenance Mode Status Card -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-header bg-transparent border-0 p-4 pb-0 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-tools text-warning fs-5"></i>
                        <h5 class="fw-bold text-dark mb-0">حالة وضع الصيانة (Maintenance Mode)</h5>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('admin.company-info.toggle-maintenance') }}" method="POST" class="d-inline">
                            @csrf
                            @if($companyInfo->is_maintenance)
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1.5 fw-bold">
                                    <i class="fas fa-power-off me-1"></i> إيقاف وضع الصيانة
                                </button>
                            @else
                                <button type="submit" class="btn btn-outline-warning btn-sm rounded-pill px-3 py-1.5 fw-bold text-dark">
                                    <i class="fas fa-power-off me-1 text-warning"></i> تشغيل وضع الصيانة
                                </button>
                            @endif
                        </form>
                        <a href="{{ route('maintenance.preview') }}" target="_blank" class="btn btn-light btn-sm rounded-pill px-3 py-1.5 text-muted fw-semibold">
                            <i class="fas fa-eye me-1 text-primary"></i> معاينة الصفحة
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 border">
                                <span class="fs-12 text-muted fw-medium d-block mb-1">حالة الموقع حالياً</span>
                                @if($companyInfo->is_maintenance)
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-pill px-3 py-1 fs-13"><i class="fas fa-circle-dot me-1"></i> تحت الصيانة</span>
                                        <small class="text-danger fs-12 fw-medium">الموقع مغلق أمام الزوار</small>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success rounded-pill px-3 py-1 fs-13"><i class="fas fa-check-circle me-1"></i> يعمل بشكل طبيعي</span>
                                        <small class="text-success fs-12 fw-medium">الموقع متاح لجميع الزوار</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 border">
                                <span class="fs-12 text-muted fw-medium d-block mb-1">عنوان صفحة الصيانة</span>
                                <h6 class="fw-bold text-dark mb-0 fs-14 text-truncate">{{ $companyInfo->maintenance_title ?: 'الموقع قيد الصيانة والتطوير حالياً (الافتراضي)' }}</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 border">
                                <span class="fs-12 text-muted fw-medium d-block mb-1">الموعد المتوقع للانتهاء</span>
                                <h6 class="fw-bold text-dark mb-0 fs-14">
                                    @if($companyInfo->maintenance_ends_at)
                                        <i class="fas fa-calendar-alt text-primary me-1"></i> {{ $companyInfo->maintenance_ends_at->format('Y/m/d - h:i A') }}
                                    @else
                                        <span class="text-muted fw-normal fs-13">غير محدد (شريط تقدم تقديري)</span>
                                    @endif
                                </h6>
                            </div>
                        </div>
                        @if($companyInfo->maintenance_message)
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="fs-12 text-muted fw-medium d-block mb-1">رسالة الصيانة للجمهور:</span>
                                <p class="text-dark mb-0 fs-14">{{ $companyInfo->maintenance_message }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

