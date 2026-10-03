@extends('layouts.admin.app')

@section('title', 'تعديل الشريك - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-edit text-primary me-2"></i> تعديل الشريك</h4>
                    <p class="text-muted fs-14 mb-0">قم بتحديث بيانات وشعار الشريك والخيارات المتاحة</p>
                </div>
                <div>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للشركاء
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold text-dark fs-14">اسم الشريك / الشركة <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" value="{{ old('name', $partner->name) }}" placeholder="مثال: شركة الحلول المتقدمة" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Website -->
                            <div class="col-md-6">
                                <label for="website" class="form-label fw-bold text-dark fs-14">رابط الموقع الإلكتروني</label>
                                <input type="url" name="website" id="website" class="form-control rounded-3 p-2.5 @error('website') is-invalid @enderror" value="{{ old('website', $partner->website) }}" placeholder="https://example.com">
                                @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image/Logo -->
                            <div class="col-md-6">
                                <label for="image" class="form-label fw-bold text-dark fs-14">شعار الشريك (Image)</label>
                                <div class="d-flex align-items-center gap-3">
                                    @if($partner->image)
                                    <div class="p-2 bg-light rounded-3 border flex-shrink-0">
                                        <img src="{{ asset('public/storage/' . $partner->image) }}" alt="{{ $partner->name }}" class="rounded-2" style="max-height: 70px; max-width: 100px; object-fit: contain;">
                                    </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" name="image" id="image" class="form-control rounded-3 p-2 @error('image') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted fs-12 d-block mt-1">اترك الحقل فارغاً إذا كنت لا ترغب باستبدال الشعار الحالي</small>
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Order -->
                            <div class="col-md-6">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض</label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', $partner->order) }}" min="0">
                                <small class="text-muted fs-12 d-block mt-1">الرقم الأصغر يظهر في البداية</small>
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold text-dark fs-14">الوصف</label>
                                <textarea name="description" id="description" rows="5" class="form-control rounded-3 p-3 @error('description') is-invalid @enderror" placeholder="وصف مختصر عن طبيعة الشراكة والخدمات المقدمة...">{{ old('description', $partner->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Switch -->
                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل الشريك وعرض شعاره في الموقع
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> تحديث التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection