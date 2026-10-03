@extends('layouts.admin.app')

@section('title', 'إدارة الخدمات - رواد البرمجة')

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
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-concierge-bell text-primary me-2"></i> إدارة الخدمات</h4>
                    <p class="text-muted fs-14 mb-0">عرض وحفظ الخدمات والحلول البرمجية التي تقدمها الشركة للعملاء</p>
                </div>
                <div>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> إضافة خدمة جديدة
                    </a>
                </div>
            </div>

            <!-- Statistical Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Services -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-layer-group fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1 fs-12 rounded-pill">الإجمالي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي الخدمات</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['total'] ?? \App\Models\Service::count() }}</h3>
                    </div>
                </div>

                <!-- Active Services -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2 py-1 fs-12 rounded-pill">نشط</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الخدمات المفعلة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['active'] ?? \App\Models\Service::where('is_active', true)->count() }}</h3>
                    </div>
                </div>

                <!-- Inactive Services -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-pause-circle fs-4"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning fw-semibold px-2 py-1 fs-12 rounded-pill">معطل</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الخدمات المعطلة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['inactive'] ?? \App\Models\Service::where('is_active', false)->count() }}</h3>
                    </div>
                </div>

                <!-- Activation Rate -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-info-subtle text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-chart-line fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-2 py-1 fs-12 rounded-pill">الأداء</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">نسبة التفعيل</h6>
                        @php
                        $totalServices = $stats['total'] ?? \App\Models\Service::count();
                        $activeServices = $stats['active'] ?? \App\Models\Service::where('is_active', true)->count();
                        $activationRate = $totalServices > 0 ? round(($activeServices / $totalServices) * 100) : 0;
                        @endphp
                        <h3 class="fw-bold text-dark mb-0">{{ $activationRate }}%</h3>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <div class="row g-3 align-items-center" id="filterForm">
                        <div class="col-md-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control bg-light border-start-0 border-end-0" placeholder="ابحث بعنوان الخدمة أو الوصف..." value="{{ request('search') }}" autocomplete="off">
                                <button class="btn btn-light border border-start-0 rounded-end-3 text-muted" type="button" id="clearSearchBtn" style="display: {{ request('search') ? 'block' : 'none' }};" title="مسح">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 d-flex gap-2">
                            <select id="statusSelect" name="status" class="form-select bg-light rounded-3">
                                <option value="">جميع الحالات</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>مفعل</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light rounded-3 text-muted px-3" title="إعادة ضبط"><i class="fas fa-undo"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Cards Grid -->
            @if($services->count() > 0)
            <div class="row g-4 mb-4" id="servicesGrid">
                @foreach($services as $service)
                <div class="col-12 col-md-6 col-lg-4 service-card-item"
                    data-title="{{ mb_strtolower($service->title, 'UTF-8') }}"
                    data-description="{{ mb_strtolower($service->description, 'UTF-8') }}"
                    data-status="{{ $service->is_active ? 'active' : 'inactive' }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-shadow transition">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="service-icon-box bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 52px; height: 52px;">
                                    <i class="{{ $service->icon ?? 'fas fa-cog' }}"></i>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    @if($service->is_active)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12">مفعل</span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fs-12">معطل</span>
                                    @endif
                                </div>
                            </div>

                            <h5 class="fw-bold text-dark mb-2">{{ $service->title }}</h5>
                            <p class="text-muted fs-14 flex-grow-1 mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.6;">
                                {{ $service->description }}
                            </p>

                            <div class="pt-3 border-top d-flex align-items-center justify-content-between mt-auto">
                                <span class="fs-12 text-muted fw-medium">#{{ $loop->iteration }}</span>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-light text-info rounded-3 px-3 fw-medium" title="تعديل">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الخدمة؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-3 px-3 fw-medium" title="حذف">
                                            <i class="fas fa-trash-alt me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Container for no dynamic search results -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 d-none" id="noSearchResults">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-search fs-1 mb-3 opacity-40"></i>
                        <h5>لا توجد نتائج تطابق بحثك</h5>
                        <p class="fs-14 mb-0">جرّب البحث بمصطلحات أخرى أو إعادة اختيار الحالة.</p>
                    </div>
                </div>
            </div>

            @if($services->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $services->links() }}
            </div>
            @endif
            @else
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-concierge-bell fs-1 mb-3 opacity-40"></i>
                        <h5>لا توجد خدمات مضافة حالياً</h5>
                        <p class="fs-14">قم بإضافة الخدمات التقنية والحلول التي تقدمها الشركة للعملاء</p>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary rounded-3 btn-sm mt-2 px-3">إضافة خدمة جديدة</a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statusSelect = document.getElementById('statusSelect');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const filterForm = document.getElementById('filterForm');
        const cards = document.querySelectorAll('.service-card-item');
        const noSearchResults = document.getElementById('noSearchResults');

        function performInstantSearch() {
            const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const status = statusSelect ? statusSelect.value : '';
            let visibleCount = 0;

            if (clearSearchBtn) {
                clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                const title = (card.getAttribute('data-title') || '').toLowerCase();
                const description = (card.getAttribute('data-description') || '').toLowerCase();
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesQuery = !query || title.includes(query) || description.includes(query);
                const matchesStatus = !status || cardStatus === status;

                if (matchesQuery && matchesStatus) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noSearchResults) {
                if (visibleCount === 0 && cards.length > 0) {
                    noSearchResults.classList.remove('d-none');
                } else {
                    noSearchResults.classList.add('d-none');
                }
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', performInstantSearch);
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performInstantSearch();
                }
            });
        }

        if (statusSelect) {
            statusSelect.addEventListener('change', performInstantSearch);
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                performInstantSearch();
                searchInput.focus();
            });
        }

        // Run on page load
        performInstantSearch();
    });
</script>
@endpush