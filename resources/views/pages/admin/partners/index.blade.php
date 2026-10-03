@extends('layouts.admin.app')

@section('title', 'شركاء النجاح - رواد البرمجة')

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
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
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-handshake text-primary me-2"></i> شركاء النجاح</h4>
                    <p class="text-muted fs-14 mb-0">إدارة قوائم وشعارات شركاء وقاطرة نجاح الشركة</p>
                </div>
                <div>
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> إضافة شريك جديد
                    </a>
                </div>
            </div>

            <!-- Statistical Overview Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Partners -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-handshake fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 fs-12 rounded-pill">إجمالي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي الشركاء</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Partner::count() }}</h3>
                    </div>
                </div>

                <!-- Active Partners -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 fs-12 rounded-pill">نشط</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الشركاء المفعلون</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Partner::where('is_active', true)->count() }}</h3>
                    </div>
                </div>

                <!-- Inactive Partners -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-danger-subtle text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-ban fs-4"></i>
                            </div>
                            <span class="badge bg-danger-subtle text-danger fw-semibold px-2.5 py-1 fs-12 rounded-pill">معطل</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الشركاء المعطلون</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Partner::where('is_active', false)->count() }}</h3>
                    </div>
                </div>

                <!-- Partners with Websites -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-info-subtle text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-globe fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-2.5 py-1 fs-12 rounded-pill">مواقع</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">مزودون بالمواقع</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Partner::whereNotNull('website')->where('website', '!=', '')->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Instant Search & Filters -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <div class="row g-3 align-items-center" id="filterForm">
                        <div class="col-md-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control bg-light border-start-0 border-end-0" placeholder="ابحث باسم الشريك، الوصف، أو الموقع الإلكتروني..." value="{{ request('search') }}" autocomplete="off">
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
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-light rounded-3 text-muted px-3" title="إعادة ضبط"><i class="fas fa-undo"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partners Grid -->
            @if($partners->count() > 0)
            <div class="row g-4 mb-4" id="partnersGrid">
                @foreach($partners as $partner)
                <div class="col-md-6 col-lg-4 partner-card-item"
                    data-name="{{ mb_strtolower($partner->name, 'UTF-8') }}"
                    data-website="{{ mb_strtolower($partner->website ?? '', 'UTF-8') }}"
                    data-description="{{ mb_strtolower(strip_tags($partner->description ?? ''), 'UTF-8') }}"
                    data-status="{{ $partner->is_active ? 'active' : 'inactive' }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden hover-shadow transition">
                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                            <div>
                                <!-- Image/Logo -->
                                <div class="partner-img-wrapper mb-3 p-3 bg-light rounded-4 d-flex align-items-center justify-content-center mx-auto border" style="height: 110px; width: 100%;">
                                    @if($partner->image)
                                    <img src="{{ asset('public/storage/' . $partner->image) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 80px; object-fit: contain;">
                                    @else
                                    <div class="text-muted"><i class="fas fa-handshake fs-1 opacity-50"></i></div>
                                    @endif
                                </div>

                                <h5 class="fw-bold text-dark mb-1">{{ $partner->name }}</h5>
                                @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" class="text-primary fs-13 text-decoration-none d-inline-block mb-2">
                                    <i class="fas fa-external-link-alt me-1"></i> زيارة الموقع
                                </a>
                                @endif

                                @if($partner->description)
                                <p class="text-muted fs-13 text-truncate-2 mb-3">{{ $partner->description }}</p>
                                @endif
                            </div>

                            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    @if($partner->is_active)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fs-12">مفعل</span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1 fs-12">معطل</span>
                                    @endif
                                    <span class="badge bg-light text-muted rounded-pill px-2.5 py-1 fs-12 ms-1">ترتيب: {{ $partner->order }}</span>
                                </div>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-sm btn-light rounded-circle text-info" title="تعديل"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت تأكد من رغبتك في حذف هذا الشريك؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle text-danger" title="حذف"><i class="fas fa-trash-alt"></i></button>
                                    </form>
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

            @if($partners->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $partners->links() }}
            </div>
            @endif

            @else
            <!-- Empty Partners State -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-handshake fs-1 mb-3 opacity-40"></i>
                        <h5>لا يوجد شركاء مضافين حالياً</h5>
                        <p class="fs-14">إضافة شعارات الشركاء تعزز من موثوقية الشركة</p>
                        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary rounded-3 btn-sm mt-2 px-3">إضافة شريك جديد</a>
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
        const cards = document.querySelectorAll('.partner-card-item');
        const noSearchResults = document.getElementById('noSearchResults');

        function performInstantSearch() {
            const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const status = statusSelect ? statusSelect.value : '';
            let visibleCount = 0;

            if (clearSearchBtn) {
                clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const website = (card.getAttribute('data-website') || '').toLowerCase();
                const description = (card.getAttribute('data-description') || '').toLowerCase();
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesQuery = !query || name.includes(query) || website.includes(query) || description.includes(query);
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

        // Run on initial load if search/filters have values
        performInstantSearch();
    });
</script>
@endpush
