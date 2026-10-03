@extends('layouts.admin.app')

@section('title', 'تفاصيل المشروع - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-briefcase text-primary me-2"></i> تفاصيل المشروع</h4>
                    <p class="text-muted fs-14 mb-0">معلومات المشروع، العميل، الصورة، ومواصفات الإنجاز</p>
                </div>
                <div class="d-flex flex-wrap gap-2 w-sm-auto justify-content-sm-end">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary rounded-3 px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-edit me-2"></i> تعديل المشروع
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-arrow-right me-2"></i> العودة للمشاريع
                    </a>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="row g-4 mb-4">
                <!-- Project Image & Quick Info -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4 text-center">
                            <div class="project-img-preview mb-4 overflow-hidden rounded-4 shadow-sm border">
                                @if($project->image)
                                <img src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid w-100 object-fit-cover" style="max-height: 280px;">
                                @else
                                <div class="bg-light p-5 text-muted"><i class="fas fa-image fs-1 opacity-50"></i></div>
                                @endif
                            </div>

                            <h4 class="fw-bold text-dark mb-2">{{ $project->title }}</h4>

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fs-13">
                                    {{ $project->category->name ?? 'غير محدد' }}
                                </span>
                                @if($project->is_featured)
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-1 fs-13"><i class="fas fa-star me-1"></i> مميز</span>
                                @endif
                                @if($project->is_active)
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-13">مفعل</span>
                                @else
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fs-13">معطل</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comprehensive Data -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-info-circle text-primary me-2"></i> مواصفات ومعلومات العمل</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-user-tie text-primary me-1"></i> العميل / الجهة</small>
                                        <span class="fw-bold text-dark fs-15">{{ $project->client_name ?? 'غير محدد' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-calendar-check text-primary me-1"></i> تاريخ الإنجاز</small>
                                        <span class="fw-bold text-dark fs-15">{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'غير محدد' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-map-marker-alt text-danger me-1"></i> الموقع الجغرافي</small>
                                        <span class="fw-bold text-dark fs-15">{{ $project->location ?? 'غير محدد' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-sort-numeric-down text-primary me-1"></i> ترتيب العرض</small>
                                        <span class="fw-bold text-dark fs-15">{{ $project->order }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-3 border">
                                <h6 class="fw-bold text-dark fs-14 mb-2"><i class="fas fa-align-right text-info me-2"></i> وصف المشروع:</h6>
                                <p class="text-muted fs-14 mb-0 leading-relaxed white-space-pre-line">{{ $project->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection