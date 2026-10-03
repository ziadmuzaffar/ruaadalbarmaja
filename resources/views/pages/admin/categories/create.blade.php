@extends('layouts.admin.app')

@section('title', 'إضافة تصنيف جديد - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-folder-plus text-primary me-2"></i> إضافة تصنيف جديد</h4>
                    <p class="text-muted fs-14 mb-0">أدخل اسم التصنيف ووصفه وأيقونته الخاصة لإضافته للمكتبة</p>
                </div>
                <div>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للتصنيفات
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold text-dark fs-14">اسم التصنيف <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="مثال: تطبيقات الجوال، المواقع الإلكترونية" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Slug -->
                            <div class="col-md-6">
                                <label for="slug" class="form-label fw-bold text-dark fs-14">الرابط المختصر (Slug)</label>
                                <input type="text" name="slug" id="slug" class="form-control rounded-3 p-2.5 @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="اتركه فارغاً للتوليد التلقائي من الاسم">
                                <small class="text-muted fs-12">يستخدم في رابط الصفحة باللغة الإنجليزية/اللاتينية</small>
                                @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Icon (FontAwesome Class) -->
                            <div class="col-md-6">
                                <label for="icon" class="form-label fw-bold text-dark fs-14">أيقونة التصنيف (FontAwesome Class)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light rounded-start-3"><i class="fas fa-icons text-muted"></i></span>
                                    <input type="text" name="icon" id="icon" class="form-control rounded-end-3 p-2.5 @error('icon') is-invalid @enderror" value="{{ old('icon', 'fas fa-folder') }}" placeholder="مثال: fas fa-mobile-alt">
                                </div>
                                <small class="text-muted fs-12">رمز أيقونة FontAwesome مثل: <code>fas fa-mobile-alt</code> أو <code>fas fa-globe</code></small>
                                @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Order -->
                            <div class="col-md-6">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض</label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                                <small class="text-muted fs-12">الرقم الأصغر يظهر في البداية (الافتراضي: 0)</small>
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold text-dark fs-14">وصف التصنيف</label>
                                <textarea name="description" id="description" rows="5" class="form-control rounded-3 p-3 @error('description') is-invalid @enderror" placeholder="اكتب وصفاً موجزاً ومميزاً عن هذا التصنيف والأعمال المتضمنة تحته...">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Switch -->
                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل التصنيف وعرضه في موقع الشركة
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> حفظ التصنيف
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

