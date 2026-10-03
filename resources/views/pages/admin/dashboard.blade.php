@extends('layouts.admin.app')

@section('title', 'لوحة التحكم الرئيسيّة - رواد البرمجة')

@push('styles')
<style>
    .hover-translate {
        transition: transform 0.25s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hover-translate:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08) !important;
    }

    .stat-card-icon {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        border-radius: 14px;
    }

    .text-purple {
        color: #7c3aed !important;
    }

    .bg-purple-subtle {
        background-color: rgba(124, 58, 237, 0.1) !important;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .quick-shortcut-btn {
        transition: all 0.2s ease-in-out;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .dark-mode .quick-shortcut-btn {
        border-color: rgba(255, 255, 255, 0.08);
    }

    .quick-shortcut-btn:hover {
        background-color: var(--bs-primary);
        color: #fff !important;
        border-color: var(--bs-primary);
    }

    .quick-shortcut-btn:hover i {
        color: #fff !important;
    }

    .project-thumb {
        width: 46px;
        height: 46px;
        object-fit: cover;
        border-radius: 10px;
    }
</style>
@endpush

@section('content')
<div class="admin-wrapper" id="adminWrapper">

    <!-- Sidebar Layout Component -->
    @include('layouts.admin.sidebar')

    <!-- Main Content Area -->
    <div class="main-content">

        <!-- Top Header Layout Component -->
        @include('layouts.admin.header')

        <div class="content-body p-4">

            <!-- Flash Status Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
            @endif

            @if(isset($companyInfo) && $companyInfo->is_maintenance)
            <div class="alert alert-warning border-0 rounded-4 shadow-sm p-3 mb-4 d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3" style="background: linear-gradient(135deg, rgba(254, 240, 138, 0.4) 0%, rgba(253, 224, 71, 0.25) 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning text-dark p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="fas fa-tools fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                            <span>الموقع حالياً في وضع الصيانة</span>
                            <span class="badge bg-danger rounded-pill px-2.5 py-1 fs-11">مغلق أمام الزوار</span>
                        </h6>
                        <small class="text-muted fs-13">يتم تحويل الزوار العاديين تلقائياً لصفحة الصيانة بينما يمكنك أنت كمدير تصفح الموقع والتحكم بالإعدادات بحرية.</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('maintenance.preview') }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-3 px-3 py-1.5 fw-semibold">
                        <i class="fas fa-eye me-1 text-primary"></i> معاينة الصفحة
                    </a>
                    <form action="{{ route('admin.company-info.toggle-maintenance') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm rounded-3 px-3 py-1.5 fw-bold shadow-xs">
                            <i class="fas fa-power-off me-1"></i> إيقاف وضع الصيانة
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- 2. Core Primary KPI Cards (4 Cards) -->
            <div class="row g-3 mb-4">

                <!-- Projects KPI -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-translate">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-card-icon bg-primary-subtle text-primary">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 fs-12 rounded-pill">
                                {{ $activeProjectsCount }} نشط
                            </span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي المشاريع</h6>
                        <div class="d-flex align-items-baseline justify-content-between">
                            <h2 class="fw-bold text-dark mb-0">{{ number_format($projectsCount) }}</h2>
                            <small class="text-muted fs-12"><i class="fas fa-star text-warning me-1"></i>{{ $featuredProjectsCount }} مميز</small>
                        </div>
                        <hr class="my-3 opacity-10">
                        <a href="{{ route('admin.projects.index') }}" class="text-primary text-decoration-none fs-13 fw-semibold d-flex align-items-center justify-content-between">
                            <span>عرض كل المشاريع</span>
                            <i class="fas fa-arrow-left fs-11"></i>
                        </a>
                    </div>
                </div>

                <!-- Services KPI -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-translate">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-card-icon bg-success-subtle text-success">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 fs-12 rounded-pill">
                                {{ $activeServicesCount }} مفعلة
                            </span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الخدمات المتاحة</h6>
                        <div class="d-flex align-items-baseline justify-content-between">
                            <h2 class="fw-bold text-dark mb-0">{{ number_format($servicesCount) }}</h2>
                            <small class="text-muted fs-12">خدمات برمجية</small>
                        </div>
                        <hr class="my-3 opacity-10">
                        <a href="{{ route('admin.services.index') }}" class="text-success text-decoration-none fs-13 fw-semibold d-flex align-items-center justify-content-between">
                            <span>إدارة الخدمات</span>
                            <i class="fas fa-arrow-left fs-11"></i>
                        </a>
                    </div>
                </div>

                <!-- Messages KPI -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-translate">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-card-icon bg-warning-subtle text-warning">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            @if($unreadMessagesCount > 0)
                            <span class="badge bg-danger text-white fw-semibold px-2.5 py-1 fs-12 rounded-pill animate__animated animate__pulse animate__infinite">
                                {{ $unreadMessagesCount }} جديد
                            </span>
                            @else
                            <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2.5 py-1 fs-12 rounded-pill">
                                مكتمل
                            </span>
                            @endif
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">رسائل التواصل</h6>
                        <div class="d-flex align-items-baseline justify-content-between">
                            <h2 class="fw-bold text-dark mb-0">{{ number_format($messagesCount) }}</h2>
                            <small class="text-muted fs-12">{{ $repliedMessagesCount }} تم الرد</small>
                        </div>
                        <hr class="my-3 opacity-10">
                        <a href="{{ route('admin.contact-messages.index') }}" class="text-warning text-decoration-none fs-13 fw-semibold d-flex align-items-center justify-content-between">
                            <span>صندوق الوارد</span>
                            <i class="fas fa-arrow-left fs-11"></i>
                        </a>
                    </div>
                </div>

                <!-- Categories & Partners KPI -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 hover-translate">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-card-icon bg-purple-subtle text-purple">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <span class="badge bg-purple-subtle text-purple fw-semibold px-2.5 py-1 fs-12 rounded-pill">
                                {{ $partnersCount }} شركاء
                            </span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">تنسيق وتصنيف المحتوى</h6>
                        <div class="d-flex align-items-baseline justify-content-between">
                            <h2 class="fw-bold text-dark mb-0">{{ number_format($categoriesCount) }}</h2>
                            <small class="text-muted fs-12">تصنيفات رئيسية</small>
                        </div>
                        <hr class="my-3 opacity-10">
                        <a href="{{ route('admin.categories.index') }}" class="text-purple text-decoration-none fs-13 fw-semibold d-flex align-items-center justify-content-between">
                            <span>استعراض التصنيفات</span>
                            <i class="fas fa-arrow-left fs-11"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- 3. Secondary Metrics & Statistics Strip -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-3 bg-body">
                <div class="row g-3 divide-x-rtl text-center">

                    <div class="col-6 col-md-3">
                        <div class="p-2">
                            <span class="fs-12 text-muted fw-medium d-block mb-1"><i class="fas fa-quote-right text-info me-1"></i> آراء العملاء</span>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format($testimonialsCount) }}</h4>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="p-2 border-start">
                            <span class="fs-12 text-muted fw-medium d-block mb-1"><i class="fas fa-handshake text-primary me-1"></i> شركاء النجاح</span>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format($partnersCount) }}</h4>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="p-2 border-start">
                            <span class="fs-12 text-muted fw-medium d-block mb-1"><i class="fas fa-chart-line text-success me-1"></i> الإحصائيات المعروضة</span>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format($statisticsCount) }}</h4>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="p-2 border-start">
                            <span class="fs-12 text-muted fw-medium d-block mb-1"><i class="fas fa-reply-all text-warning me-1"></i> نسبة الرد على الرسائل</span>
                            @php
                            $responseRate = $messagesCount > 0 ? round(($repliedMessagesCount / $messagesCount) * 100) : 100;
                            @endphp
                            <h4 class="fw-bold text-dark mb-0">{{ $responseRate }}%</h4>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 4. Interactive ApexCharts Section -->
            <div class="row g-4 mb-4">

                <!-- Monthly Messages Chart -->
                <div class="col-12 col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-1"><i class="fas fa-chart-area text-primary me-2"></i> نشاط رسائل التواصل</h5>
                                <p class="text-muted fs-13 mb-0">إحصائية نمو الاستفسارات والرسائل الواردة خلال الأقسام الأخيرة</p>
                            </div>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1.5 fs-12 fw-semibold">مخطط زمني</span>
                        </div>
                        <div class="card-body p-4">
                            <div id="messagesActivityChart" style="min-height: 310px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Projects Distribution Donut Chart -->
                <div class="col-12 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-1"><i class="fas fa-chart-pie text-purple me-2"></i> توزيع المشاريع</h5>
                                <p class="text-muted fs-13 mb-0">توزيع الأعمال حسب التصنيفات الرئيسية</p>
                            </div>
                            <span class="badge bg-purple-subtle text-purple rounded-pill px-3 py-1.5 fs-12 fw-semibold">حسب التصنيف</span>
                        </div>
                        <div class="card-body p-4 d-flex align-items-center justify-content-center">
                            @if(count($categoryProjectsCounts) > 0 && array_sum($categoryProjectsCounts) > 0)
                            <div id="projectsCategoryChart" class="w-100" style="min-height: 310px;"></div>
                            @else
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-folder-open fs-1 opacity-25 mb-3"></i>
                                <p class="mb-0 fs-14">لا توجد مشاريع مخصصة للتصنيفات حتى الآن</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- 5. Recent Activity Lists Section (Projects & Messages) -->
            <div class="row g-4 mb-4">

                <!-- Recent Projects -->
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-briefcase text-primary me-2"></i> أحدث المشاريع</h5>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fs-13 text-muted">
                                مشاهدة الكل <i class="fas fa-arrow-left ms-1 fs-11"></i>
                            </a>
                        </div>
                        <div class="card-body px-4 pb-4 pt-2">
                            <div class="d-flex flex-column gap-3">
                                @forelse($recentProjects as $project)
                                <div class="d-flex align-items-center justify-content-between p-2.5 rounded-3 bg-light-subtle border border-light-subtle hover-translate">
                                    <div class="d-flex align-items-center gap-3 overflow-hidden">
                                        @if($project->image)
                                        <img src="{{ asset('public/storage/' . $project->image) }}" class="project-thumb shadow-sm" alt="{{ $project->title }}">
                                        @else
                                        <div class="project-thumb bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-5">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <h6 class="fw-bold text-dark mb-1 text-truncate fs-14" title="{{ $project->title }}">{{ $project->title }}</h6>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-0.5 rounded-pill">{{ $project->category->name ?? 'بدون تصنيف' }}</span>
                                                <span class="fs-12 text-muted">{{ $project->created_at ? $project->created_at->format('Y-m-d') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-2">
                                        @if($project->is_featured)
                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1 fs-11" title="مشروع مميز"><i class="fas fa-star"></i></span>
                                        @endif
                                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-light rounded-circle text-primary" title="معاينة"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-folder-open fs-2 mb-2 opacity-30"></i>
                                    <p class="mb-0 fs-14">لم يتم إضافة مشاريع بعد</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Contact Messages -->
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-envelope text-warning me-2"></i> أحدث الرسائل الواردة</h5>
                            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fs-13 text-muted">
                                صندوق الرسائل <i class="fas fa-arrow-left ms-1 fs-11"></i>
                            </a>
                        </div>
                        <div class="card-body px-4 pb-4 pt-2">
                            <div class="d-flex flex-column gap-3">
                                @forelse($recentMessages as $msg)
                                @php
                                $isUnread = !$msg->read_at;
                                @endphp
                                <div class="d-flex align-items-center justify-content-between p-2.5 rounded-3 {{ $isUnread ? 'bg-primary-subtle border border-primary-subtle' : 'bg-light-subtle border border-light-subtle' }} hover-translate">
                                    <div class="d-flex align-items-center gap-3 overflow-hidden">
                                        <div class="avatar-initials {{ $isUnread ? 'bg-primary text-white' : 'bg-secondary-subtle text-secondary' }} rounded-circle d-flex align-items-center justify-content-center fw-bold fs-14 flex-shrink-0" style="width: 42px; height: 42px;">
                                            {{ strtoupper(mb_substr($msg->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="overflow-hidden">
                                            <div class="d-flex align-items-center gap-2">
                                                <h6 class="fw-bold text-dark mb-0 text-truncate fs-14">{{ $msg->name }}</h6>
                                                @if($isUnread)
                                                <span class="badge bg-danger rounded-pill px-2 py-0.5 fs-10">جديد</span>
                                                @endif
                                            </div>
                                            <p class="text-muted fs-12 mb-0 text-truncate fw-medium">{{ $msg->subject ?? $msg->message }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-2">
                                        <span class="fs-11 text-muted">{{ $msg->created_at ? $msg->created_at->diffForHumans() : '' }}</span>
                                        <a href="{{ route('admin.contact-messages.show', $msg->id) }}" class="btn btn-sm btn-light rounded-circle text-info" title="قراءة الرسالة"><i class="fas fa-chevron-left"></i></a>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fs-2 mb-2 opacity-30"></i>
                                    <p class="mb-0 fs-14">لا توجد رسائل واردة حالياً</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 6. Quick Control Panel Shortcuts -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="fas fa-rocket text-primary me-2"></i> الوصول السريع والتحكم</h5>
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ route('admin.company-info.edit') }}" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-sliders text-primary fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">إعدادات الموقع والصيانة</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ route('admin.statistics.index') }}" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-chart-bar text-success fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">الأرقام والإحصائيات</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ route('admin.partners.index') }}" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-handshake text-info fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">شركاء النجاح</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ route('admin.testimonials.index') }}" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-comment-dots text-warning fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">آراء العملاء</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ route('admin.profile.show') }}" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-user-shield text-purple fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">الملف الشخصي</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="/" target="_blank" class="quick-shortcut-btn d-flex flex-column align-items-center justify-content-center p-3 rounded-4 bg-light text-decoration-none text-dark h-100">
                            <i class="fas fa-globe text-secondary fs-3 mb-2"></i>
                            <span class="fs-13 fw-semibold text-center">معاينة الموقع</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDarkMode = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        const labelColor = isDarkMode ? '#94a3b8' : '#64748b';
        const gridColor = isDarkMode ? '#334155' : '#f1f5f9';

        // 1. Messages Monthly Activity Chart (Area Chart)
        const monthlyLabels = @json($monthlyLabels ?? []);
        const monthlyCounts = @json($monthlyCounts ?? []);

        // Fallback demo labels if database is fresh
        const labelsData = monthlyLabels.length > 0 ? monthlyLabels : ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'];
        const seriesData = monthlyCounts.length > 0 ? monthlyCounts : [0, 0, 0, 0, 0, 0];

        const messagesChartOptions = {
            series: [{
                name: 'الرسائل الواردة',
                data: seriesData
            }],
            chart: {
                type: 'area',
                height: 310,
                fontFamily: 'Cairo, sans-serif',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true
                }
            },
            colors: ['#0d6efd'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            xaxis: {
                categories: labelsData,
                labels: {
                    style: {
                        colors: labelColor,
                        fontFamily: 'Cairo'
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontFamily: 'Cairo'
                    },
                    formatter: function(val) {
                        return Math.floor(val);
                    }
                }
            },
            grid: {
                borderColor: gridColor,
                strokeDashArray: 4
            },
            tooltip: {
                theme: isDarkMode ? 'dark' : 'light',
                y: {
                    formatter: function(val) {
                        return val + " رسالة";
                    }
                }
            }
        };

        const messagesChartEl = document.getElementById('messagesActivityChart');
        if (messagesChartEl && typeof ApexCharts !== 'undefined') {
            const messagesChart = new ApexCharts(messagesChartEl, messagesChartOptions);
            messagesChart.render();
        }

        // 2. Projects Category Donut Chart
        const categoryNames = @json($categoryNames ?? []);
        const categoryCounts = @json($categoryProjectsCounts ?? []);

        if (categoryNames.length > 0 && categoryCounts.length > 0 && typeof ApexCharts !== 'undefined') {
            const projectsChartEl = document.getElementById('projectsCategoryChart');
            if (projectsChartEl) {
                const projectsChartOptions = {
                    series: categoryCounts,
                    labels: categoryNames,
                    chart: {
                        type: 'donut',
                        height: 310,
                        fontFamily: 'Cairo, sans-serif'
                    },
                    colors: ['#0d6efd', '#7c3aed', '#198754', '#ffc107', '#0dcaf0', '#fd7e14', '#6c757d'],
                    legend: {
                        position: 'bottom',
                        labels: {
                            colors: labelColor,
                            useSeriesColors: false
                        },
                        fontFamily: 'Cairo'
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: 'Cairo'
                        }
                    },
                    stroke: {
                        show: true,
                        colors: [isDarkMode ? '#1e293b' : '#ffffff'],
                        width: 2
                    },
                    tooltip: {
                        theme: isDarkMode ? 'dark' : 'light',
                        y: {
                            formatter: function(val) {
                                return val + " مشروع";
                            }
                        }
                    }
                };

                const projectsChart = new ApexCharts(projectsChartEl, projectsChartOptions);
                projectsChart.render();
            }
        }
    });
</script>
@endpush