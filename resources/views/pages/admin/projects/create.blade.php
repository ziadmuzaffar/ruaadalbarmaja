@extends('layouts.admin.app')

@section('title', 'إضافة مشروع جديد - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-plus-circle text-primary me-2"></i> إضافة مشروع جديد</h4>
                    <p class="text-muted fs-14 mb-0">أدخل تفاصيل ومواصفات المشروع الجديد وصورته الرائعة</p>
                </div>
                <div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للمشاريع
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Project Title -->
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-bold text-dark fs-14">عنوان المشروع <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control rounded-3 p-2.5 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="مثال: تطبيق توصيل الشحنات، متجر تحف سحابي" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-4">
                                <label for="category_id" class="form-label fw-bold text-dark fs-14">التصنيف <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select rounded-3 p-2.5 @error('category_id') is-invalid @enderror" required>
                                    <option value="">اختر التصنيف</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6">
                                <label for="image" class="form-label fw-bold text-dark fs-14">صورة المشروع الرئيسية <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control rounded-3 p-2 @error('image') is-invalid @enderror" accept="image/*" required>
                                <small class="text-muted fs-12">الصيغ المسموحة: jpeg, png, jpg, webp (الحد الأقصى 10MB)</small>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Client Name -->
                            <div class="col-md-6">
                                <label for="client_name" class="form-label fw-bold text-dark fs-14">اسم العميل / الجهة</label>
                                <input type="text" name="client_name" id="client_name" class="form-control rounded-3 p-2.5 @error('client_name') is-invalid @enderror" value="{{ old('client_name') }}" placeholder="مثال: شركة النواة، وزارة التجارة">
                                @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Completion Date -->
                            <div class="col-md-4">
                                <label for="completion_date" class="form-label fw-bold text-dark fs-14">تاريخ الإنجاز</label>
                                <input type="date" name="completion_date" id="completion_date" class="form-control rounded-3 p-2.5 @error('completion_date') is-invalid @enderror" value="{{ old('completion_date') }}">
                                @error('completion_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="col-md-4">
                                <label for="location" class="form-label fw-bold text-dark fs-14">الموقع الجغرافي</label>
                                <input type="text" name="location" id="location" class="form-control rounded-3 p-2.5 @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="مثال: الرياض، السعودية">
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Order -->
                            <div class="col-md-4">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض</label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                                <small class="text-muted fs-12">الرقم الأصغر يظهر في البداية (الافتراضي: 0)</small>
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold text-dark fs-14">وصف المشروع التفصيلي <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="5" class="form-control rounded-3 p-3 @error('description') is-invalid @enderror" placeholder="اكتب شرحاً شاملاً عن تكنولوجيا المشروع والحلول المقدمة فيه..." required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Switches (Active & Featured) -->
                            <div class="col-md-6">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل المشروع وعرضه في المعرض
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_featured">
                                        تمييز المشروع (إظهاره في الصفحة الرئيسية)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> حفظ المشروع
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
