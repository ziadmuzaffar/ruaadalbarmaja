@extends('layouts.admin.app')

@section('title', 'إدارة الإحصائيات - رواد البرمجة')

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .text-purple {
        color: #7c3aed !important;
    }

    .bg-purple-subtle {
        background-color: rgba(124, 58, 237, 0.1) !important;
    }
</style>
@endpush

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
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-chart-bar text-primary me-2"></i> إدارة أرقام وإحصائيات الشركة</h4>
                    <p class="text-muted fs-14 mb-0">عرض العدادات اليدوية والتلقائية المعروضة في واجهة الصفحة الرئيسية</p>
                </div>
                <div>
                    <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> إضافة إحصائية جديدة
                    </a>
                </div>
            </div>

            <!-- Statistical Overview Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Statistics -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-chart-bar fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 fs-12 rounded-pill">إجمالي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي الإحصائيات</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Statistic::count() }}</h3>
                    </div>
                </div>

                <!-- Active Statistics -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 fs-12 rounded-pill">مفعل</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الإحصائيات المفعلة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Statistic::where('is_active', true)->count() }}</h3>
                    </div>
                </div>

                <!-- Auto Statistics -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-purple-subtle text-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-magic fs-4"></i>
                            </div>
                            <span class="badge bg-purple-subtle text-purple fw-semibold px-2.5 py-1 fs-12 rounded-pill">تلقائي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إحصائيات تلقائية</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Statistic::where('type', 'auto')->count() }}</h3>
                    </div>
                </div>

                <!-- Manual Statistics -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-info-subtle text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-keyboard fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-2.5 py-1 fs-12 rounded-pill">يدوي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إحصائيات يدوية</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Statistic::where('type', 'manual')->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Instant Search & Filters -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <div class="row g-3 align-items-center" id="filterForm">
                        <div class="col-md-6 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control bg-light border-start-0 border-end-0" placeholder="ابحث بالعنوان، التسمية، أو القيمة..." value="{{ request('search') }}" autocomplete="off">
                                <button class="btn btn-light border border-start-0 rounded-end-3 text-muted" type="button" id="clearSearchBtn" style="display: {{ request('search') ? 'block' : 'none' }};" title="مسح">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <select id="typeSelect" name="type" class="form-select bg-light rounded-3">
                                <option value="">جميع الأنواع</option>
                                <option value="manual" {{ request('type') === 'manual' ? 'selected' : '' }}>يدوي (Manual)</option>
                                <option value="auto" {{ request('type') === 'auto' ? 'selected' : '' }}>تلقائي (Auto)</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-3 d-flex gap-2">
                            <select id="statusSelect" name="status" class="form-select bg-light rounded-3">
                                <option value="">جميع الحالات</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>مفعل</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @if(request()->hasAny(['search', 'type', 'status']))
                            <a href="{{ route('admin.statistics.index') }}" class="btn btn-light rounded-3 text-muted px-3" title="إعادة ضبط"><i class="fas fa-undo"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards Grid -->
            @if($statistics->count() > 0)
            <div class="row g-4 mb-4" id="statisticsGrid">
                @foreach($statistics as $statistic)
                <div class="col-md-6 col-lg-4 statistic-card-item"
                    data-title="{{ mb_strtolower($statistic->title, 'UTF-8') }}"
                    data-label="{{ mb_strtolower($statistic->label ?? '', 'UTF-8') }}"
                    data-value="{{ mb_strtolower($statistic->value ?? '', 'UTF-8') }}"
                    data-display-value="{{ mb_strtolower($statistic->display_value ?? '', 'UTF-8') }}"
                    data-type="{{ $statistic->type }}"
                    data-status="{{ $statistic->is_active ? 'active' : 'inactive' }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden hover-shadow transition">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Header Info -->
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="stat-icon-box bg-primary-subtle text-primary rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                                        <i class="{{ $statistic->icon ?? 'fas fa-chart-line' }} fs-3"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h5 class="fw-bold text-dark mb-1 text-truncate" title="{{ $statistic->title }}">{{ $statistic->title }}</h5>
                                        <span class="text-muted fs-13 text-truncate d-block" title="{{ $statistic->label }}">{{ $statistic->label }}</span>
                                    </div>
                                </div>

                                <!-- Display Value Box -->
                                <div class="bg-light border rounded-3 p-3 text-center my-3">
                                    <small class="text-muted fs-12 d-block mb-1">القيمة المعروضة</small>
                                    <div class="fw-bold text-primary fs-3 font-monospace">
                                        {{ $statistic->display_value }}
                                    </div>
                                </div>
                            </div>

                            <div>
                                <!-- Badges & Metadata -->
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pt-2">
                                    <div>
                                        @if($statistic->type === 'auto')
                                        <span class="badge bg-purple-subtle text-purple rounded-pill px-2.5 py-1 fs-12">
                                            <i class="fas fa-magic me-1"></i> تلقائي
                                        </span>
                                        @else
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2.5 py-1 fs-12">
                                            <i class="fas fa-keyboard me-1"></i> يدوي
                                        </span>
                                        @endif

                                        @if($statistic->is_active)
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fs-12">مفعل</span>
                                        @else
                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1 fs-12">معطل</span>
                                        @endif
                                    </div>
                                    <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1 fs-12">الترتيب: {{ $statistic->order }}</span>
                                </div>

                                <!-- Actions Footer -->
                                <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                    <span class="fs-12 text-muted">
                                        @if($statistic->type === 'auto' && $statistic->source_model)
                                        {{ class_basename($statistic->source_model) }}
                                        @endif
                                    </span>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.statistics.edit', $statistic->id) }}" class="btn btn-sm btn-light rounded-circle text-info" title="تعديل"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.statistics.destroy', $statistic->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذه الإحصائية؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light rounded-circle text-danger" title="حذف"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Client-side No Search Results State -->
            <div id="noSearchResults" class="card border-0 shadow-sm rounded-4 d-none mb-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-search fs-1 mb-3 opacity-40"></i>
                        <h5>لم يتم العثور على نتائج مطابقة</h5>
                        <p class="fs-14 text-muted">جرب البحث بكلمات مختلفة أو تغيير حالة التصفية</p>
                    </div>
                </div>
            </div>

            @if($statistics->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $statistics->links() }}
            </div>
            @endif

            @else
            <!-- Empty Statistics State -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-chart-pie fs-1 mb-3 opacity-40"></i>
                        <h5>لا توجد إحصائيات مضافة حالياً</h5>
                        <p class="fs-14">إضافة الإحصائيات يعكس قوة الأعمال وسنوات الخبرة للزوار</p>
                        <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary rounded-3 btn-sm mt-2 px-3">إضافة إحصائية جديدة</a>
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
        const typeSelect = document.getElementById('typeSelect');
        const statusSelect = document.getElementById('statusSelect');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const cards = document.querySelectorAll('.statistic-card-item');
        const noSearchResults = document.getElementById('noSearchResults');

        function performInstantSearch() {
            const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const type = typeSelect ? typeSelect.value : '';
            const status = statusSelect ? statusSelect.value : '';
            let visibleCount = 0;

            if (clearSearchBtn) {
                clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                const title = (card.getAttribute('data-title') || '').toLowerCase();
                const label = (card.getAttribute('data-label') || '').toLowerCase();
                const value = (card.getAttribute('data-value') || '').toLowerCase();
                const displayValue = (card.getAttribute('data-display-value') || '').toLowerCase();
                const cardType = card.getAttribute('data-type') || '';
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesQuery = !query || title.includes(query) || label.includes(query) || value.includes(query) || displayValue.includes(query);
                const matchesType = !type || cardType === type;
                const matchesStatus = !status || cardStatus === status;

                if (matchesQuery && matchesType && matchesStatus) {
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

        if (typeSelect) {
            typeSelect.addEventListener('change', performInstantSearch);
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

        // Initial run
        performInstantSearch();
    });
</script>
@endpush

