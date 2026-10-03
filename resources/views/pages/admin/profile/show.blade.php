@extends('layouts.admin.app')

@section('title', 'الملف الشخصي - رواد البرمجة')

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
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-user-circle text-primary me-2"></i> الملف الشخصي</h4>
                    <p class="text-muted fs-14 mb-0">عرض تفاصيل حساب المدير وإعدادات الأمان</p>
                </div>
                <div class="d-flex flex-wrap gap-2 w-sm-auto justify-content-sm-end">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary rounded-3 px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0">
                        <i class="fas fa-user-cog me-2"></i> تعديل بيانات الحساب
                    </a>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="row g-4 mb-4">
                <!-- Profile Avatar & Quick Info -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4 text-center">
                            <div class="avatar-large-container mb-4 overflow-hidden d-flex justify-content-center">
                                <div class="avatar-large bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold fs-1 shadow" style="width: 100px; height: 100px;">
                                    {{ strtoupper(mb_substr($user->name ?? 'A', 0, 1)) }}
                                </div>
                            </div>

                            <h4 class="fw-bold text-dark mb-2">{{ $user->name }}</h4>

                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fs-13">
                                    <i class="fas fa-shield-alt me-1"></i> مدير النظام (Admin)
                                </span>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-13">
                                    <i class="fas fa-check-circle me-1"></i> نشط
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comprehensive Data -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-transparent border-0 p-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-info-circle text-primary me-2"></i> تفاصيل الحساب والأمان</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-user text-primary me-1"></i> الاسم الكامل</small>
                                        <span class="fw-bold text-dark fs-15">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-envelope text-primary me-1"></i> البريد الإلكتروني</small>
                                        <span class="fw-bold text-dark fs-15">{{ $user->email }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3">
                                        <small class="text-muted d-block mb-1"><i class="fas fa-calendar-alt text-primary me-1"></i> تاريخ إنشاء الحساب</small>
                                        <span class="fw-bold text-dark fs-15">{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection