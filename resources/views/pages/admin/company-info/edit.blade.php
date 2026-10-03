@extends('layouts.admin.app')

@section('title', 'تعديل معلومات الشركة - رواد البرمجة')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-edit text-primary me-2"></i> تعديل بيانات الشركة</h4>
                    <p class="text-muted fs-14 mb-0">قم بتحديث معلومات الشركة والاتصال وشعار المؤسسة</p>
                </div>
                <div>
                    <a href="{{ route('admin.company-info.show') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة لمعلومات الشركة
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.company-info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- General Information -->
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fas fa-building me-2"></i> المعلومات الأساسية</h5>

                        <div class="row g-4 mb-4">
                            <!-- Company Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold text-dark fs-14">اسم الشركة <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" value="{{ old('name', $companyInfo->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Founded Year -->
                            <div class="col-md-6">
                                <label for="founded_year" class="form-label fw-bold text-dark fs-14">سنة التأسيس <span class="text-danger">*</span></label>
                                <input type="number" name="founded_year" id="founded_year" class="form-control rounded-3 p-2.5 @error('founded_year') is-invalid @enderror" value="{{ old('founded_year', $companyInfo->founded_year) }}" min="1900" max="{{ date('Y') }}" required>
                                @error('founded_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description / Slogan -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold text-dark fs-14">الوصف المختصر (الشعار اللفظي) <span class="text-danger">*</span></label>
                                <input type="text" name="description" id="description" class="form-control rounded-3 p-2.5 @error('description') is-invalid @enderror" value="{{ old('description', $companyInfo->description) }}" required>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- About Company -->
                            <div class="col-12">
                                <label for="about" class="form-label fw-bold text-dark fs-14">نبذة عن الشركة <span class="text-danger">*</span></label>
                                <textarea name="about" id="about" rows="4" class="form-control rounded-3 p-3 @error('about') is-invalid @enderror" required>{{ old('about', $companyInfo->about) }}</textarea>
                                @error('about')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Company Logo -->
                            <div class="col-md-12">
                                <label for="logo" class="form-label fw-bold text-dark fs-14">شعار الشركة (Logo)</label>
                                <div class="d-flex align-items-center gap-4">
                                    @if($companyInfo->logo)
                                    <div class="logo-preview-box p-2 bg-light rounded-3 border">
                                        <img src="{{ asset('public/storage/' . $companyInfo->logo) }}" alt="Logo" style="max-height: 70px;">
                                    </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" name="logo" id="logo" class="form-control rounded-3 p-2 @error('logo') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted fs-12">أنواع الصور المسموحة: png, jpg, jpeg, webp, svg (الحد الأقصى 10MB)</small>
                                        @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Address -->
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom mt-4"><i class="fas fa-map-marker-alt me-2"></i> بيانات الاتصال والعنوان</h5>

                        <div class="row g-4 mb-4">
                            <!-- Email -->
                            <div class="col-md-4">
                                <label for="email" class="form-label fw-bold text-dark fs-14">البريد الإلكتروني <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control rounded-3 p-2.5 @error('email') is-invalid @enderror" value="{{ old('email', $companyInfo->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-4">
                                <label for="phone" class="form-label fw-bold text-dark fs-14">رقم الهاتف <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control rounded-3 p-2.5 @error('phone') is-invalid @enderror" value="{{ old('phone', $companyInfo->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Whatsapp -->
                            <div class="col-md-4">
                                <label for="whatsapp" class="form-label fw-bold text-dark fs-14">رقم الواتساب</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control rounded-3 p-2.5 @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $companyInfo->whatsapp) }}">
                                @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-4">
                                <label for="city" class="form-label fw-bold text-dark fs-14">المدينة <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control rounded-3 p-2.5 @error('city') is-invalid @enderror" value="{{ old('city', $companyInfo->city) }}" required>
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- District -->
                            <div class="col-md-4">
                                <label for="district" class="form-label fw-bold text-dark fs-14">الحي <span class="text-danger">*</span></label>
                                <input type="text" name="district" id="district" class="form-control rounded-3 p-2.5 @error('district') is-invalid @enderror" value="{{ old('district', $companyInfo->district) }}" required>
                                @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Street -->
                            <div class="col-md-4">
                                <label for="street" class="form-label fw-bold text-dark fs-14">الشارع</label>
                                <input type="text" name="street" id="street" class="form-control rounded-3 p-2.5 @error('street') is-invalid @enderror" value="{{ old('street', $companyInfo->street) }}">
                                @error('street')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Address -->
                            <div class="col-md-6">
                                <label for="address" class="form-label fw-bold text-dark fs-14">العنوان التفصيلي <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control rounded-3 p-2.5 @error('address') is-invalid @enderror" value="{{ old('address', $companyInfo->address) }}" required>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Working Hours -->
                            <div class="col-md-6">
                                <label for="working_hours" class="form-label fw-bold text-dark fs-14">أوقات العمل الرسمية</label>
                                <input type="text" name="working_hours" id="working_hours" class="form-control rounded-3 p-2.5 @error('working_hours') is-invalid @enderror" value="{{ old('working_hours', $companyInfo->working_hours) }}" placeholder="مثال: الأحد - الخميس | 8:00 صباحاً - 5:00 مساءً">
                                @error('working_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <h5 class="fw-bold text-primary mb-2 pb-2 border-bottom mt-4"><i class="fas fa-share-alt me-2"></i> روابط التواصل الاجتماعي</h5>
                        <p class="text-muted fs-14 mb-4"><i class="fas fa-info-circle me-1"></i> جميع مواقع التواصل الاجتماعي اختيارية. عند ترك الحقل فارغاً لن يظهر رمز الوسيلة في الموقع.</p>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="facebook_url" class="form-label fw-bold text-dark fs-14">رابط Facebook <span class="text-muted fw-normal fs-12">(اختياري)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fab fa-facebook text-primary"></i></span>
                                    <input type="url" name="facebook_url" id="facebook_url" class="form-control p-2.5 @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $companyInfo->facebook_url) }}" placeholder="https://facebook.com/...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="twitter_url" class="form-label fw-bold text-dark fs-14">رابط Twitter / X <span class="text-muted fw-normal fs-12">(اختياري)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fab fa-twitter text-info"></i></span>
                                    <input type="url" name="twitter_url" id="twitter_url" class="form-control p-2.5 @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $companyInfo->twitter_url) }}" placeholder="https://twitter.com/...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="linkedin_url" class="form-label fw-bold text-dark fs-14">رابط LinkedIn <span class="text-muted fw-normal fs-12">(اختياري)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fab fa-linkedin text-primary"></i></span>
                                    <input type="url" name="linkedin_url" id="linkedin_url" class="form-control p-2.5 @error('linkedin_url') is-invalid @enderror" value="{{ old('linkedin_url', $companyInfo->linkedin_url) }}" placeholder="https://linkedin.com/in/...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="instagram_url" class="form-label fw-bold text-dark fs-14">رابط Instagram <span class="text-muted fw-normal fs-12">(اختياري)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fab fa-instagram text-danger"></i></span>
                                    <input type="url" name="instagram_url" id="instagram_url" class="form-control p-2.5 @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $companyInfo->instagram_url) }}" placeholder="https://instagram.com/...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="tiktok_url" class="form-label fw-bold text-dark fs-14">رابط TikTok <span class="text-muted fw-normal fs-12">(اختياري)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fab fa-tiktok text-dark"></i></span>
                                    <input type="url" name="tiktok_url" id="tiktok_url" class="form-control p-2.5 @error('tiktok_url') is-invalid @enderror" value="{{ old('tiktok_url', $companyInfo->tiktok_url) }}" placeholder="https://tiktok.com/@...">
                                </div>
                            </div>
                        </div>

                        <!-- Sections Visibility Control -->
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom mt-4">
                            <i class="fas fa-layer-group me-2"></i> التحكم في ظهور أقسام الصفحة الرئيسية
                        </h5>
                        <p class="text-muted fs-14 mb-4">قم بتفعيل أو تعطيل الأقسام التي ترغب في إظهارها في الصفحة الرئيسية للموقع</p>

                        <div class="row g-3 mb-4">
                            <!-- Hero Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_hero_section">
                                        <i class="fas fa-star text-warning me-2"></i> قسم البداية (Hero)
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_hero_section" id="show_hero_section" value="1" {{ old('show_hero_section', $companyInfo->show_hero_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- About Us Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_about_section">
                                        <i class="fas fa-info-circle text-primary me-2"></i> قسم من نحن
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_about_section" id="show_about_section" value="1" {{ old('show_about_section', $companyInfo->show_about_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Services Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_services_section">
                                        <i class="fas fa-concierge-bell text-success me-2"></i> قسم الخدمات
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_services_section" id="show_services_section" value="1" {{ old('show_services_section', $companyInfo->show_services_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_statistics_section">
                                        <i class="fas fa-chart-bar text-info me-2"></i> قسم الإحصائيات
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_statistics_section" id="show_statistics_section" value="1" {{ old('show_statistics_section', $companyInfo->show_statistics_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Projects Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_projects_section">
                                        <i class="fas fa-briefcase text-primary me-2"></i> قسم معرض الأعمال
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_projects_section" id="show_projects_section" value="1" {{ old('show_projects_section', $companyInfo->show_projects_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonials Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_testimonials_section">
                                        <i class="fas fa-quote-right text-warning me-2"></i> قسم آراء العملاء
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_testimonials_section" id="show_testimonials_section" value="1" {{ old('show_testimonials_section', $companyInfo->show_testimonials_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Partners Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_partners_section">
                                        <i class="fas fa-handshake text-secondary me-2"></i> قسم شركاء النجاح
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_partners_section" id="show_partners_section" value="1" {{ old('show_partners_section', $companyInfo->show_partners_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Section -->
                            <div class="col-md-6 col-lg-3">
                                <div class="p-3 bg-light rounded-3 border h-100 d-flex align-items-center justify-content-between">
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer" for="show_contact_section">
                                        <i class="fas fa-envelope text-danger me-2"></i> قسم تواصل معنا
                                    </label>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="show_contact_section" id="show_contact_section" value="1" {{ old('show_contact_section', $companyInfo->show_contact_section ?? true) ? 'checked' : '' }} style="width: 40px; height: 22px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Mode Section -->
                        <div class="card border border-warning-subtle rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, rgba(254, 240, 138, 0.12) 0%, rgba(253, 224, 71, 0.04) 100%);">
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4 pb-3 border-bottom border-warning-subtle">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning-subtle text-warning p-3" style="width: 52px; height: 52px;">
                                        <i class="fas fa-tools fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                                            <span>إعدادات وضع الصيانة (Maintenance Mode)</span>
                                            @if($companyInfo->is_maintenance)
                                                <span class="badge bg-danger rounded-pill px-2.5 py-1 fs-12"><i class="fas fa-circle-dot me-1"></i> مفعّل حالياً</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fs-12"><i class="fas fa-check-circle me-1"></i> معطل (الموقع متاح)</span>
                                            @endif
                                        </h5>
                                        <p class="text-muted fs-13 mb-0">عند تفعيل وضع الصيانة، يتم توجيه الزوار إلى صفحة صيانة مخصصة واحترافية بينما يمكن للمدراء تصفح الموقع واللوحة بحرية.</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('maintenance.preview') }}" target="_blank" class="btn btn-outline-dark rounded-3 px-3 py-2 fs-13 fw-semibold text-nowrap shadow-xs">
                                        <i class="fas fa-eye me-1.5 text-primary"></i> معاينة صفحة الصيانة
                                    </a>
                                </div>
                            </div>

                            <!-- Toggle Switch Box -->
                            <div class="p-3 bg-white rounded-3 border mb-4 d-flex align-items-center justify-content-between shadow-xs">
                                <div>
                                    <label class="form-check-label fw-bold text-dark fs-14 mb-0 cursor-pointer d-flex align-items-center gap-2" for="is_maintenance">
                                        <i class="fas fa-power-off {{ $companyInfo->is_maintenance ? 'text-danger' : 'text-muted' }}"></i>
                                        تشغيل وضع الصيانة للموقع
                                    </label>
                                    <small class="text-muted fs-12 d-block mt-0.5">فعّل هذا المفتاح لتحويل جميع الزوار العاديين فوراً إلى صفحة الصيانة.</small>
                                </div>
                                <div class="form-check form-switch p-0 m-0">
                                    <input class="form-check-input ms-0 float-none cursor-pointer" type="checkbox" name="is_maintenance" id="is_maintenance" value="1" {{ old('is_maintenance', $companyInfo->is_maintenance) ? 'checked' : '' }} style="width: 48px; height: 26px;">
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- Maintenance Page Title -->
                                <div class="col-md-6">
                                    <label for="maintenance_title" class="form-label fw-bold text-dark fs-14">
                                        عنوان صفحة الصيانة الرئيسية
                                    </label>
                                    <input type="text" name="maintenance_title" id="maintenance_title" class="form-control rounded-3 p-2.5 @error('maintenance_title') is-invalid @enderror" value="{{ old('maintenance_title', $companyInfo->maintenance_title) }}" placeholder="مثال: الموقع قيد الصيانة والتطوير حالياً">
                                    <small class="text-muted fs-12">إذا ترك فارغاً سيتم استخدام العنوان الافتراضي.</small>
                                    @error('maintenance_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expected End Time -->
                                <div class="col-md-6">
                                    <label for="maintenance_ends_at" class="form-label fw-bold text-dark fs-14">
                                        الموعد المتوقع للانتهاء (تفعيل العد التنازلي)
                                    </label>
                                    <input type="datetime-local" name="maintenance_ends_at" id="maintenance_ends_at" class="form-control rounded-3 p-2.5 @error('maintenance_ends_at') is-invalid @enderror" value="{{ old('maintenance_ends_at', $companyInfo->maintenance_ends_at ? $companyInfo->maintenance_ends_at->format('Y-m-d\TH:i') : '') }}">
                                    <small class="text-muted fs-12">اختياري - عند تحديده سيظهر عدّاد تنازلي تفاعلي أنيق للزوار.</small>
                                    @error('maintenance_ends_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Maintenance Message -->
                                <div class="col-12">
                                    <label for="maintenance_message" class="form-label fw-bold text-dark fs-14">
                                        رسالة وتفاصيل الصيانة للجمهور
                                    </label>
                                    <textarea name="maintenance_message" id="maintenance_message" rows="3" class="form-control rounded-3 p-3 @error('maintenance_message') is-invalid @enderror" placeholder="مثال: نقوم حالياً بترقية خدماتنا وأنظمتنا البرمجية لنقدم لكم تجربة استثنائية. سنعود قريباً جداً!">{{ old('maintenance_message', $companyInfo->maintenance_message) }}</textarea>
                                    <small class="text-muted fs-12">تظهر هذه الرسالة أسفل العنوان مباشرة في شاشة الصيانة.</small>
                                    @error('maintenance_message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Active Checkbox -->
                        <div class="col-12 mb-4">
                            <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                <input class="form-check-input ms-0 float-none" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $companyInfo->is_active) ? 'checked' : '' }} style="width: 45px; height: 24px;">
                                <label class="form-check-label fw-bold text-dark fs-14 mb-0" for="is_active">
                                    تفعيل بيانات ومعلومات الشركة
                                </label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.company-info.show') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i> حفظ التحديثات
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

