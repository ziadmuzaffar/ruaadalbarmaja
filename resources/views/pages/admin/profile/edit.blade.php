@extends('layouts.admin.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
<div class="admin-wrapper" id="adminWrapper">
    @include('layouts.admin.sidebar')

    <div class="main-content">
        @include('layouts.admin.header')

        <div class="content-body p-3 p-md-4">

            <!-- Page Header -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-user-cog text-primary me-2"></i> تعديل بيانات الحساب</h4>
                    <p class="text-muted fs-14 mb-0">قم بتحديث اسم المدير والبريد الإلكتروني وكلمة المرور</p>
                </div>
                <div>
                    <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold text-nowrap d-inline-flex align-items-center justify-content-center w-100 w-sm-auto">
                        <i class="fas fa-arrow-right me-2"></i> العودة للملف الشخصي
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 mx-auto">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- General Details -->
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom"><i class="fas fa-id-card me-2"></i> البيانات الشخصية</h5>

                        <div class="row g-4 mb-4">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold text-dark fs-14">الاسم <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold text-dark fs-14">البريد الإلكتروني <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control rounded-3 p-2.5 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Security / Password -->
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom mt-4"><i class="fas fa-lock me-2"></i> تغيير كلمة المرور (اختياري)</h5>

                        <div class="row g-4">
                            <!-- Current Password -->
                            <div class="col-md-12">
                                <label for="current_password" class="form-label fw-bold text-dark fs-14">كلمة المرور الحالية</label>
                                <input type="password" name="current_password" id="current_password" class="form-control rounded-3 p-2.5 @error('current_password') is-invalid @enderror" placeholder="مطلوبة فقط إذا أردت تغيير كلمة المرور">
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-bold text-dark fs-14">كلمة المرور الجديدة</label>
                                <input type="password" name="password" id="password" class="form-control rounded-3 p-2.5 @error('password') is-invalid @enderror" placeholder="اتركها فارغة لعدم التغيير (8 أحرف على الأقل)">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-bold text-dark fs-14">تأكيد كلمة المرور الجديدة</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3 p-2.5" placeholder="أعد كتابة كلمة المرور الجديدة">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch align-items-sm-center justify-content-sm-end gap-2">
                            <a href="{{ route('admin.profile.show') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold text-center">إلغاء</a>
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

