@extends('layouts.admin.app')

@section('title', 'إدارة المشاريع - رواد البرمجة')

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08) !important;
    }

    .transition-scale {
        transition: transform 0.4s ease;
    }

    .project-card:hover .transition-scale {
        transform: scale(1.06);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }

    .hover-bg-primary:hover {
        background-color: var(--bs-primary) !important;
        color: #fff !important;
        border-color: var(--bs-primary) !important;
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
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-briefcase text-primary me-2"></i> إدارة المشاريع</h4>
                    <p class="text-muted fs-14 mb-0">عرض وإضافة وتعديل مشاريع الشركة والمعرض التفاعلي</p>
                </div>
                <div>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> إضافة مشروع جديد
                    </a>
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Projects -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-briefcase fs-4"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 fs-12 rounded-pill">المشاريع</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي المشاريع</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Project::count() }}</h3>
                    </div>
                </div>

                <!-- Active Projects -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success-subtle text-success rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-check-circle fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-semibold px-2.5 py-1 fs-12 rounded-pill">مفعلة</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">المشاريع النشطة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Project::where('is_active', true)->count() }}</h3>
                    </div>
                </div>

                <!-- Featured Projects -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-warning-subtle text-warning rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-star fs-4"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning fw-semibold px-2.5 py-1 fs-12 rounded-pill">مميزة</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">مشاريع مميزة</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ \App\Models\Project::where('is_featured', true)->count() }}</h3>
                    </div>
                </div>

                <!-- Categories Count -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-info-subtle text-info rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-folder-open fs-4"></i>
                            </div>
                            <span class="badge bg-info-subtle text-info fw-semibold px-2.5 py-1 fs-12 rounded-pill">التصنيفات</span>
                        </div>
                        <h6 class="text-muted fw-medium fs-14 mb-1">إجمالي التصنيفات</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $categories->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('admin.projects.index') }}" method="GET" class="row g-3 align-items-center" id="filterForm" onsubmit="return false;">
                        <div class="col-md-5 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" id="searchInput" name="search" class="form-control bg-light border-start-0 border-end-0" placeholder="ابحث باسم المشروع، العميل، أو الموقع..." value="{{ request('search') }}" autocomplete="off">
                                <button class="btn btn-light border border-start-0 rounded-end-3 text-muted" type="button" id="clearSearchBtn" style="display: {{ request('search') ? 'block' : 'none' }};" title="مسح">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <select id="categorySelect" name="category_id" class="form-select bg-light rounded-3">
                                <option value="">جميع التصنيفات</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-3 d-flex gap-2">
                            <select id="statusSelect" name="status" class="form-select bg-light rounded-3">
                                <option value="">جميع الحالات</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>مفعل</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>معطل</option>
                            </select>
                            @if(request()->hasAny(['search', 'category_id', 'status', 'featured']))
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-light rounded-3 text-muted px-3" title="إعادة ضبط"><i class="fas fa-undo"></i></a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Projects Cards Grid -->
            @if($projects->count() > 0)
            <div class="row g-4 mb-4" id="projectsGrid">
                @foreach($projects as $project)
                <div class="col-12 col-md-6 col-lg-4 project-card-item"
                    data-title="{{ mb_strtolower($project->title, 'UTF-8') }}"
                    data-client="{{ mb_strtolower($project->client_name ?? '', 'UTF-8') }}"
                    data-location="{{ mb_strtolower($project->location ?? '', 'UTF-8') }}"
                    data-description="{{ mb_strtolower(strip_tags($project->description ?? ''), 'UTF-8') }}"
                    data-category="{{ $project->category_id }}"
                    data-status="{{ $project->is_active ? 'active' : 'inactive' }}">

                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-shadow transition overflow-hidden project-card position-relative">
                        <!-- Image Header -->
                        <div class="project-card-img-wrapper position-relative overflow-hidden" style="height: 190px;">
                            @if($project->image)
                            <img src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-100 h-100 object-fit-cover transition-scale">
                            @else
                            <div class="w-100 h-100 border-bottom d-flex flex-column align-items-center justify-content-center text-dark p-3 text-center">
                                <i class="fas fa-briefcase fs-1 mb-2 opacity-75"></i>
                                <span class="fs-12 fw-medium opacity-75">رواد البرمجة</span>
                            </div>
                            @endif

                            <!-- Badges Overlay -->
                            <div class="position-absolute top-0 start-0 end-0 p-3 d-flex align-items-center justify-content-between pointer-events-none">
                                <span class="badge bg-white text-primary shadow-sm rounded-pill px-3 py-1.5 fs-12 fw-bold opacity-95">
                                    <i class="fas fa-folder me-1 text-primary opacity-75"></i> {{ $project->category->name ?? 'غير محدد' }}
                                </span>

                                <div class="d-flex align-items-center gap-1">
                                    @if($project->is_featured)
                                    <span class="badge bg-warning text-dark shadow-sm rounded-pill px-2.5 py-1.5 fs-12 fw-bold" title="مشروع مميز">
                                        <i class="fas fa-star me-1"></i> مميز
                                    </span>
                                    @endif
                                    @if($project->is_active)
                                    <span class="badge bg-success shadow-sm text-white rounded-pill px-2.5 py-1.5 fs-12 fw-semibold">مفعل</span>
                                    @else
                                    <span class="badge bg-danger shadow-sm text-white rounded-pill px-2.5 py-1.5 fs-12 fw-semibold">معطل</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold text-dark mb-2 text-truncate" title="{{ $project->title }}">{{ $project->title }}</h5>

                            @if($project->location)
                            <p class="text-muted fs-13 mb-3 text-truncate">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $project->location }}
                            </p>
                            @else
                            <p class="text-muted fs-13 mb-3 opacity-50">
                                <i class="fas fa-map-marker-alt me-1"></i> الموقع غير محدد
                            </p>
                            @endif

                            @if($project->description)
                            <p class="text-muted fs-14 mb-3 text-secondary" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 42px; line-height: 1.5;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 85) }}
                            </p>
                            @else
                            <div class="mb-3" style="min-height: 42px;"></div>
                            @endif

                            <!-- Details Box -->
                            <div class="bg-light rounded-3 p-3 mb-3 mt-auto border border-light-subtle">
                                <div class="d-flex align-items-center justify-content-between fs-13 mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-user-tie text-primary me-1 opacity-75"></i> العميل:
                                    </span>
                                    <span class="fw-semibold text-dark text-truncate ms-2" style="max-width: 150px;">
                                        {{ $project->client_name ?? 'غير محدد' }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between fs-13">
                                    <span class="text-muted">
                                        <i class="far fa-calendar-alt text-primary me-1 opacity-75"></i> الإنجاز:
                                    </span>
                                    <span class="fw-semibold text-dark">
                                        {{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'غير محدد' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Actions Footer -->
                            <div class="pt-3 border-top d-flex align-items-center justify-content-between gap-2">
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-light text-primary border rounded-3 px-3 fw-semibold flex-grow-1 text-center hover-bg-primary" title="عرض التفاصيل">
                                    <i class="fas fa-eye me-1"></i> تفاصيل
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-light text-info border rounded-3 px-2.5 py-1.5 fw-semibold" title="تعديل">
                                    <i class="fas fa-edit me-1"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت تأكد من رغبتك في حذف هذا المشروع؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger border rounded-3 px-2.5 py-1.5 fw-semibold" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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

            @if($projects->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->links() }}
            </div>
            @endif

            @else
            <!-- Empty Projects State -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-briefcase fs-1 mb-3 opacity-40"></i>
                        <h5>لا توجد مشاريع مضافة حالياً</h5>
                        <p class="fs-14">قم بإضافة أول مشروع لإبراز إنجازات الشركة في البورتفوليو</p>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-3 btn-sm mt-2 px-3">إضافة مشروع جديد</a>
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
        const categorySelect = document.getElementById('categorySelect');
        const statusSelect = document.getElementById('statusSelect');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const cards = document.querySelectorAll('.project-card-item');
        const noSearchResults = document.getElementById('noSearchResults');

        function performInstantSearch() {
            const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const category = categorySelect ? categorySelect.value : '';
            const status = statusSelect ? statusSelect.value : '';
            let visibleCount = 0;

            if (clearSearchBtn) {
                clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                const title = (card.getAttribute('data-title') || '').toLowerCase();
                const client = (card.getAttribute('data-client') || '').toLowerCase();
                const location = (card.getAttribute('data-location') || '').toLowerCase();
                const description = (card.getAttribute('data-description') || '').toLowerCase();
                const cardCategory = card.getAttribute('data-category') || '';
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesQuery = !query || title.includes(query) || client.includes(query) || location.includes(query) || description.includes(query);
                const matchesCategory = !category || cardCategory === category;
                const matchesStatus = !status || cardStatus === status;

                if (matchesQuery && matchesCategory && matchesStatus) {
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
        }

        if (categorySelect) {
            categorySelect.addEventListener('change', performInstantSearch);
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