@extends('layouts.admin.app')

@section('title', 'إضافة خدمة جديدة - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-plus-circle text-primary me-2"></i> إضافة خدمة جديدة</h4>
                    <p class="text-muted fs-14 mb-0">أدخل عنوان الخدمة ووصفها وأيقونتها الخاصة</p>
                </div>
                <div>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للخدمات
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Title -->
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-bold text-dark fs-14">عنوان الخدمة <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control rounded-3 p-2.5 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="مثال: تطوير تطبيقات الجوال، تصميم المواقع" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Order -->
                            <div class="col-md-4">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض</label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Icon (FontAwesome Class) -->
                            <div class="col-12">
                                <label for="icon" class="form-label fw-bold text-dark fs-14">أيقونة الخدمة (FontAwesome Class)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light rounded-start-3"><i class="fas fa-icons text-muted"></i></span>
                                    <input type="text" name="icon" id="icon" class="form-control rounded-end-3 p-2.5 @error('icon') is-invalid @enderror" value="{{ old('icon', 'fas fa-laptop-code') }}" placeholder="مثال: fas fa-mobile-alt">
                                </div>
                                <small class="text-muted fs-12">أدخل اسم كلاس أيقونة FontAwesome مثل <code>fas fa-code</code> أو <code>fas fa-cloud</code></small>
                                @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold text-dark fs-14">وصف الخدمة الشامل <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="5" class="form-control rounded-3 p-3 @error('description') is-invalid @enderror" placeholder="اكتب شرحاً موجزاً ومميزاً عما تضمنه هذه الخدمة والمزايا المقدمة للعميل..." required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Switch -->
                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل الخدمة وعرضها في موقع الشركة
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> حفظ الخدمة
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection