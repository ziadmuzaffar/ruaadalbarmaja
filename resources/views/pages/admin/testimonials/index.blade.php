@extends('layouts.admin.app')

@section('title', 'آراء العملاء - رواد البرمجة')

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
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-quote-right text-primary me-2"></i> آراء العملاء</h4>
                    <p class="text-muted fs-14 mb-0">عرض وتعديل شهادات العملاء والشركاء المعروضة في موقع الشركة</p>
                </div>
                <div>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> إضافة شهادة جديدة
                    </a>
                </div>
            </div>

            <!-- Statistical Overview Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Testimonials -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-quote-right fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 fs-12 rounded-pill">إجمالي</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي الشهادات</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Testimonial::count() }}</h3>
                    </div>
                </div>

                <!-- Active Testimonials -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 fs-12 rounded-pill">نشط</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">الشهادات المفعلة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Testimonial::where('is_active', true)->count() }}</h3>
                    </div>
                </div>

                <!-- 5-Star Ratings -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-star fs-4"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning fw-semibold px-2.5 py-1 fs-12 rounded-pill">5 نجوم</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">تقييمات ممتازة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Testimonial::where('rating', 5)->count() }}</h3>
                    </div>
                </div>

                <!-- Average Rating -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-info-subtle text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-chart-line fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-2.5 py-1 fs-12 rounded-pill">المتوسط</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">متوسط التقييم العام</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ number_format(\App\Models\Testimonial::avg('rating') ?? 5, 1) }} <span class="fs-14 text-muted fw-normal">/ 5</span></h3>
                    </div>
                </div>
            </div>

            <!-- Filters Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <div class="row g-3 align-items-center" id="filterForm">
                        <div class="col-md-5 col-lg-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control bg-light border-start-0 border-end-0" placeholder="اسم العميل، المسمى، الشركة، أو النص..." value="{{ request('search') }}" autocomplete="off">
                                <button class="btn btn-light border border-start-0 rounded-end-3 text-muted" type="button" id="clearSearchBtn" style="display: {{ request('search') ? 'block' : 'none' }};" title="مسح">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <select id="ratingSelect" name="rating" class="form-select bg-light rounded-3">
                                <option value="">جميع التقييمات</option>
                                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 نجوم ⭐⭐⭐⭐⭐</option>
                                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 نجوم ⭐⭐⭐⭐</option>
                                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 نجوم ⭐⭐⭐</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4 d-flex gap-2">
                            <select id="statusSelect" name="status" class="form-select bg-light rounded-3">
                                <option value="">جميع الحالات</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>مفعل</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @if(request()->hasAny(['search', 'rating', 'status']))
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light rounded-3 text-muted px-3" title="إعادة ضبط"><i class="fas fa-undo"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Grid -->
            @if($testimonials->count() > 0)
            <div class="row g-4 mb-4" id="testimonialsGrid">
                @foreach($testimonials as $item)
                <div class="col-md-6 col-lg-4 testimonial-card-item"
                    data-name="{{ mb_strtolower($item->client_name, 'UTF-8') }}"
                    data-position="{{ mb_strtolower($item->client_position ?? '', 'UTF-8') }}"
                    data-company="{{ mb_strtolower($item->client_company ?? '', 'UTF-8') }}"
                    data-testimonial="{{ mb_strtolower(strip_tags($item->testimonial ?? ''), 'UTF-8') }}"
                    data-rating="{{ $item->rating }}"
                    data-status="{{ $item->is_active ? 'active' : 'inactive' }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 position-relative hover-shadow transition">
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Rating Stars -->
                                <div class="text-warning mb-3 fs-14">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=$item->rating)
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="far fa-star opacity-40"></i>
                                        @endif
                                        @endfor
                                </div>

                                <!-- Testimonial Content -->
                                <p class="text-muted fs-14 italic mb-4 leading-relaxed text-truncate-3">
                                    "{{ $item->testimonial }}"
                                </p>
                            </div>

                            <div>
                                <!-- Client Profile Header -->
                                <div class="d-flex align-items-center gap-3 pt-3 border-top mb-3">
                                    @if($item->client_image)
                                    <img src="{{ asset('public/storage/' . $item->client_image) }}" alt="{{ $item->client_name }}" class="rounded-circle object-fit-cover shadow-sm" style="width: 44px; height: 44px;">
                                    @else
                                    <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                        {{ strtoupper(mb_substr($item->client_name, 0, 1)) }}
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 fs-14">{{ $item->client_name }}</h6>
                                        <small class="text-muted fs-12 d-block">
                                            {{ $item->client_position ? $item->client_position . ($item->client_company ? ' - ' . $item->client_company : '') : ($item->client_company ?? 'عميل') }}
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if($item->is_active)
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fs-12">مفعل</span>
                                        @else
                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1 fs-12">معطل</span>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="btn btn-sm btn-light rounded-circle text-info" title="تعديل"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت تأكد من رغبتك في حذف هذا التقييم؟');">
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
                        <p class="fs-14 text-muted">جرب البحث بكلمات مختلفة أو تغيير الفلاتر المحددة</p>
                    </div>
                </div>
            </div>

            @if($testimonials->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $testimonials->links() }}
            </div>
            @endif

            @else
            <!-- Empty Testimonials State -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-quote-right fs-1 mb-3 opacity-40"></i>
                        <h5>لا توجد آراء عملاء مضافة حالياً</h5>
                        <p class="fs-14">إضافة آراء وتجارب العملاء تزيد من المبيعات وثقة الزوار</p>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-3 btn-sm mt-2 px-3">إضافة شهادة جديدة</a>
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
        const ratingSelect = document.getElementById('ratingSelect');
        const statusSelect = document.getElementById('statusSelect');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const cards = document.querySelectorAll('.testimonial-card-item');
        const noSearchResults = document.getElementById('noSearchResults');

        function performInstantSearch() {
            const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const rating = ratingSelect ? ratingSelect.value : '';
            const status = statusSelect ? statusSelect.value : '';
            let visibleCount = 0;

            if (clearSearchBtn) {
                clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const position = (card.getAttribute('data-position') || '').toLowerCase();
                const company = (card.getAttribute('data-company') || '').toLowerCase();
                const testimonial = (card.getAttribute('data-testimonial') || '').toLowerCase();
                const cardRating = card.getAttribute('data-rating') || '';
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesQuery = !query || name.includes(query) || position.includes(query) || company.includes(query) || testimonial.includes(query);
                const matchesRating = !rating || cardRating === rating;
                const matchesStatus = !status || cardStatus === status;

                if (matchesQuery && matchesRating && matchesStatus) {
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

        if (ratingSelect) {
            ratingSelect.addEventListener('change', performInstantSearch);
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