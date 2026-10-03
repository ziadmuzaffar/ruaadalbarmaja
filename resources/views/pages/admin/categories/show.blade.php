@extends('layouts.admin.app')

@section('title', 'تفاصيل التصنيف - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-folder text-primary me-2"></i> تفاصيل التصنيف</h4>
                    <p class="text-muted fs-14 mb-0">عرض كافة البيانات وإحصائيات المشاريع المندرجة تحت هذا التصنيف</p>
                </div>
                <div class="d-flex flex-wrap gap-2 w-sm-auto justify-content-sm-end">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary rounded-3 px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-edit me-2"></i> تعديل التصنيف
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-arrow-right me-2"></i> العودة للتصنيفات
                    </a>
                </div>
            </div>

            <!-- Details Card -->
            <div class="row g-4 mb-4">
                <!-- Main Category Info -->
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <div class="text-center pb-4 border-bottom mb-4">
                                <div class="category-big-icon bg-primary-subtle text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 72px; height: 72px;">
                                    <i class="{{ $category->icon ?? 'fas fa-folder' }} fs-2"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1 fs-18">{{ $category->name }}</h5>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-2 fs-12 font-monospace px-2.5 py-1">
                                    <i class="fas fa-link me-1 opacity-75"></i>{{ $category->slug }}
                                </span>
                            </div>

                            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                <li class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                    <span class="text-muted fs-14 fw-medium"><i class="fas fa-toggle-on text-primary me-2"></i> حالة العرض:</span>
                                    @if($category->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold">مفعل</span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 fw-semibold">معطل</span>
                                    @endif
                                </li>
                                <li class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                    <span class="text-muted fs-14 fw-medium"><i class="fas fa-sort-numeric-down text-secondary me-2"></i> ترتيب العرض:</span>
                                    <span class="fw-bold text-dark fs-14">#{{ $category->order }}</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                    <span class="text-muted fs-14 fw-medium"><i class="fas fa-briefcase text-info me-2"></i> عدد المشاريع:</span>
                                    <span class="badge bg-primary rounded-pill px-3 py-1 fs-13 fw-bold">{{ $category->projects_count ?? $category->projects->count() }} مشروع</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                    <span class="text-muted fs-14 fw-medium"><i class="fas fa-calendar-alt text-warning me-2"></i> تاريخ الإضافة:</span>
                                    <span class="fw-medium text-dark fs-13">{{ $category->created_at ? $category->created_at->format('Y-m-d') : '-' }}</span>
                                </li>
                            </ul>

                            @if($category->description)
                            <div class="mt-4 pt-3 border-top">
                                <h6 class="fw-bold text-dark fs-14 mb-2"><i class="fas fa-align-right text-primary me-2"></i> الوصف:</h6>
                                <p class="text-muted fs-14 mb-0" style="line-height: 1.7;">{{ $category->description }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Category Projects List -->
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 p-4 pb-0 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                            <div>
                                <h5 class="fw-bold text-dark mb-1"><i class="fas fa-briefcase text-primary me-2"></i> مشاريع التصنيف</h5>
                                <small class="text-muted fs-13">قائمة المشاريع البرمجية المندرجة تحت هذا التصنيف</small>
                            </div>
                            <a href="{{ route('admin.projects.create', ['category_id' => $category->id]) }}" class="btn btn-sm btn-primary rounded-3 px-3 py-2 fw-bold shadow-sm">
                                <i class="fas fa-plus me-1"></i> إضافة مشروع لهذا التصنيف
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                @forelse($category->projects as $project)
                                <div class="col-12 col-md-6">
                                    <div class="card border rounded-4 h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body p-3 d-flex flex-column">
                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                @if($project->image)
                                                <img src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}" class="rounded-3 object-fit-cover shadow-sm" style="width: 52px; height: 52px; min-width: 52px;">
                                                @else
                                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border" style="width: 52px; height: 52px; min-width: 52px;">
                                                    <i class="fas fa-image fs-4"></i>
                                                </div>
                                                @endif
                                                <div class="overflow-hidden">
                                                    <h6 class="fw-bold text-dark mb-1 text-truncate fs-14">{{ $project->title }}</h6>
                                                    <small class="text-muted fs-12 d-block text-truncate"><i class="fas fa-user me-1 text-primary"></i> {{ $project->client_name ?? 'غير محدد' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                                <div>
                                                    @if($project->is_active)
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fs-12 fw-medium">مفعل</span>
                                                    @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 fs-12 fw-medium">معطل</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center gap-1">
                                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-light rounded-circle text-primary" title="عرض"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-light rounded-circle text-info" title="تعديل"><i class="fas fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fs-1 mb-3 opacity-40"></i>
                                    <h6 class="fw-bold text-dark mb-1">لا توجد مشاريع مضافة حالياً</h6>
                                    <p class="mb-3 fs-14">لم يتم ربط أي مشروع بهذا التصنيف حتى الآن</p>
                                    <a href="{{ route('admin.projects.create', ['category_id' => $category->id]) }}" class="btn btn-sm btn-outline-primary rounded-3 px-3 py-1.5 fw-semibold">
                                        إضافة أول مشروع
                                    </a>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection