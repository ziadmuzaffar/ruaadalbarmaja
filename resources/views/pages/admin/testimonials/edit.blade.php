@extends('layouts.admin.app')

@section('title', 'تعديل الشهادة - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-edit text-primary me-2"></i> تعديل شهادة العميل</h4>
                    <p class="text-muted fs-14 mb-0">قم بتحديث بيانات وتقييم العميل والخيارات المتاحة</p>
                </div>
                <div>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للآراء
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Client Name -->
                            <div class="col-md-6">
                                <label for="client_name" class="form-label fw-bold text-dark fs-14">اسم العميل <span class="text-danger">*</span></label>
                                <input type="text" name="client_name" id="client_name" class="form-control rounded-3 p-2.5 @error('client_name') is-invalid @enderror" value="{{ old('client_name', $testimonial->client_name) }}" required>
                                @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Client Position -->
                            <div class="col-md-6">
                                <label for="client_position" class="form-label fw-bold text-dark fs-14">المسمى الوظيفي</label>
                                <input type="text" name="client_position" id="client_position" class="form-control rounded-3 p-2.5 @error('client_position') is-invalid @enderror" value="{{ old('client_position', $testimonial->client_position) }}">
                                @error('client_position')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Client Company -->
                            <div class="col-md-6">
                                <label for="client_company" class="form-label fw-bold text-dark fs-14">اسم الشركة / الجهة</label>
                                <input type="text" name="client_company" id="client_company" class="form-control rounded-3 p-2.5 @error('client_company') is-invalid @enderror" value="{{ old('client_company', $testimonial->client_company) }}">
                                @error('client_company')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Rating (1 to 5 Stars) -->
                            <div class="col-md-6">
                                <label for="rating" class="form-label fw-bold text-dark fs-14">التقييم (عدد النجوم) <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-select rounded-3 p-2.5 @error('rating') is-invalid @enderror" required>
                                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 نجوم ⭐⭐⭐⭐⭐ (ممتاز جداً)</option>
                                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 نجوم ⭐⭐⭐⭐ (جيد جداً)</option>
                                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 نجوم ⭐⭐⭐ (جيد)</option>
                                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>نجتان ⭐⭐ (مقبول)</option>
                                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>نجمة واحدة ⭐ (ضعيف)</option>
                                </select>
                                @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Client Image -->
                            <div class="col-md-6">
                                <label for="client_image" class="form-label fw-bold text-dark fs-14">صورة العميل (الشخصية)</label>
                                <div class="d-flex align-items-center gap-3">
                                    @if($testimonial->client_image)
                                    <div class="p-2 bg-light rounded-3 border flex-shrink-0">
                                        <img src="{{ asset('public/storage/' . $testimonial->client_image) }}" alt="{{ $testimonial->client_name }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" name="client_image" id="client_image" class="form-control rounded-3 p-2 @error('client_image') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted fs-12 d-block mt-1">اترك الحقل فارغاً إذا كنت لا ترغب باستبدال الصورة الحالية</small>
                                        @error('client_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Order -->
                            <div class="col-md-6">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض</label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', $testimonial->order) }}" min="0">
                                <small class="text-muted fs-12 d-block mt-1">الرقم الأصغر يظهر في البداية</small>
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Testimonial Text -->
                            <div class="col-12">
                                <label for="testimonial" class="form-label fw-bold text-dark fs-14">نص التقييم / الرأي <span class="text-danger">*</span></label>
                                <textarea name="testimonial" id="testimonial" rows="4" class="form-control rounded-3 p-3 @error('testimonial') is-invalid @enderror" required>{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                                @error('testimonial')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Switch -->
                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل التقييم وعرضه في سلايدر التقييمات
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
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