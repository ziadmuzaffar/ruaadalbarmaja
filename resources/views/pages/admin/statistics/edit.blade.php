@extends('layouts.admin.app')

@section('title', 'تعديل الإحصائية')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-edit text-primary me-2"></i> تعديل الإحصائية</h4>
                    <p class="text-muted fs-14 mb-0">قم بتعديل قيم ونوع وأيقونة الإحصائية والخيارات المتاحة</p>
                </div>
                <div>
                    <a href="{{ route('admin.statistics.index') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للإحصائيات
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.statistics.update', $statistic->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Title -->
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-bold text-dark fs-14">عنوان الإحصائية <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control rounded-3 p-2.5 @error('title') is-invalid @enderror" value="{{ old('title', $statistic->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Label -->
                            <div class="col-md-6">
                                <label for="label" class="form-label fw-bold text-dark fs-14">التسمية التوضيحية <span class="text-danger">*</span></label>
                                <input type="text" name="label" id="label" class="form-control rounded-3 p-2.5 @error('label') is-invalid @enderror" value="{{ old('label', $statistic->label) }}" required>
                                @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Statistic Type (Manual vs Auto) -->
                            <div class="col-md-6">
                                <label for="type" class="form-label fw-bold text-dark fs-14">نوع حساب الإحصائية <span class="text-danger">*</span></label>
                                <select name="type" id="typeSelect" class="form-select rounded-3 p-2.5 @error('type') is-invalid @enderror" required>
                                    <option value="manual" {{ old('type', $statistic->type) === 'manual' ? 'selected' : '' }}>يدوي (قيمة ثابتة مدخلة)</option>
                                    <option value="auto" {{ old('type', $statistic->type) === 'auto' ? 'selected' : '' }}>تلقائي (محسوب ديناميكياً من قاعدة البيانات)</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Value (for Manual) -->
                            <div class="col-md-6" id="manualValueWrapper">
                                <label for="value" class="form-label fw-bold text-dark fs-14">القيمة الرقمية/النصية</label>
                                <input type="text" name="value" id="value" class="form-control rounded-3 p-2.5 @error('value') is-invalid @enderror" value="{{ old('value', $statistic->value) }}">
                                @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Auto Calculation Fields -->
                            <div class="col-md-4 auto-field" id="sourceModelWrapper" style="display: none;">
                                <label for="source_model" class="form-label fw-bold text-dark fs-14">نموذج مصدر البيانات</label>
                                <select name="source_model" id="source_model" class="form-select rounded-3 p-2.5 @error('source_model') is-invalid @enderror">
                                    <option value="App\Models\Project" {{ old('source_model', $statistic->source_model) === 'App\Models\Project' ? 'selected' : '' }}>المشاريع (Project)</option>
                                    <option value="App\Models\Service" {{ old('source_model', $statistic->source_model) === 'App\Models\Service' ? 'selected' : '' }}>الخدمات (Service)</option>
                                    <option value="App\Models\Partner" {{ old('source_model', $statistic->source_model) === 'App\Models\Partner' ? 'selected' : '' }}>الشركاء (Partner)</option>
                                    <option value="App\Models\Testimonial" {{ old('source_model', $statistic->source_model) === 'App\Models\Testimonial' ? 'selected' : '' }}>آراء العملاء (Testimonial)</option>
                                    <option value="App\Models\ContactMessage" {{ old('source_model', $statistic->source_model) === 'App\Models\ContactMessage' ? 'selected' : '' }}>الرسائل (ContactMessage)</option>
                                </select>
                                @error('source_model')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 auto-field" id="calcMethodWrapper" style="display: none;">
                                <label for="calculation_method" class="form-label fw-bold text-dark fs-14">طريقة الحساب</label>
                                <select name="calculation_method" id="calculation_method" class="form-select rounded-3 p-2.5 @error('calculation_method') is-invalid @enderror">
                                    <option value="count" {{ old('calculation_method', $statistic->calculation_method) === 'count' ? 'selected' : '' }}>عد كافة السجلات (Count)</option>
                                    <option value="sum" {{ old('calculation_method', $statistic->calculation_method) === 'sum' ? 'selected' : '' }}>مجموع السجلات (Sum)</option>
                                    <option value="avg" {{ old('calculation_method', $statistic->calculation_method) === 'avg' ? 'selected' : '' }}>متوسط السجلات (Avg)</option>
                                </select>
                                @error('calculation_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 auto-field" id="suffixWrapper" style="display: none;">
                                <label for="suffix" class="form-label fw-bold text-dark fs-14">اللاحقة (Suffix)</label>
                                <input type="text" name="suffix" id="suffix" class="form-control rounded-3 p-2.5 @error('suffix') is-invalid @enderror" value="{{ old('suffix', $statistic->suffix) }}">
                                @error('suffix')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">
                                <label for="icon" class="form-label fw-bold text-dark fs-14">أيقونة الإحصائية (FontAwesome Class)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light rounded-start-3"><i class="{{ old('icon', $statistic->icon ?? 'fas fa-chart-line') }}" id="iconPreview"></i></span>
                                    <input type="text" name="icon" id="icon" class="form-control rounded-end-3 p-2.5 @error('icon') is-invalid @enderror" value="{{ old('icon', $statistic->icon) }}">
                                </div>
                                @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Order -->
                            <div class="col-md-6">
                                <label for="order" class="form-label fw-bold text-dark fs-14">ترتيب العرض <span class="text-danger">*</span></label>
                                <input type="number" name="order" id="order" class="form-control rounded-3 p-2.5 @error('order') is-invalid @enderror" value="{{ old('order', $statistic->order) }}" min="0" required>
                                <small class="text-muted fs-12 d-block mt-1">الرقم الأصغر يظهر في البداية</small>
                                @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Active Switch -->
                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $statistic->is_active) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                        تفعيل الإحصائية وعرضها في شريط العدادات
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.statistics.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('typeSelect');
        const manualValueWrapper = document.getElementById('manualValueWrapper');
        const autoFields = document.querySelectorAll('.auto-field');
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('iconPreview');

        function toggleTypeFields() {
            if (typeSelect.value === 'auto') {
                manualValueWrapper.style.display = 'none';
                autoFields.forEach(el => el.style.display = 'block');
            } else {
                manualValueWrapper.style.display = 'block';
                autoFields.forEach(el => el.style.display = 'none');
            }
        }

        if (typeSelect) {
            typeSelect.addEventListener('change', toggleTypeFields);
            toggleTypeFields();
        }

        if (iconInput && iconPreview) {
            iconInput.addEventListener('input', function() {
                iconPreview.className = this.value.trim() ? this.value.trim() : 'fas fa-chart-line';
            });
        }
    });
</script>
@endpush