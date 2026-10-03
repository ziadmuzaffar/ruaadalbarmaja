@extends('layouts.admin.app')

@section('title', 'عرض الرسالة - رواد البرمجة')

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
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-envelope text-primary me-2"></i> تفاصيل الرسالة</h4>
                    <p class="text-muted fs-14 mb-0">عرض موضوع ونص الرسالة وإدارة حالتها والملاحظات</p>
                </div>
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary rounded-3 px-3 fw-semibold">
                    <i class="fas fa-arrow-right me-1"></i> العودة لصندوق الرسائل
                </a>
            </div>

            <div class="row g-4">
                <!-- Message Body -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-transparent border-bottom p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">{{ $contactMessage->subject ?? 'بدون عنوان' }}</h5>
                                <small class="text-muted"><i class="fas fa-clock me-1"></i> تاريخ الاستلام: {{ $contactMessage->created_at ? $contactMessage->created_at->format('Y-m-d H:i:s') : '-' }}</small>
                            </div>
                            <div>
                                @switch($contactMessage->status)
                                    @case('new')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1.5 fs-13">جديدة</span>
                                        @break
                                    @case('read')
                                        <span class="badge bg-info-subtle text-info rounded-pill px-3 py-1.5 fs-13">مقروءة</span>
                                        @break
                                    @case('replied')
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1.5 fs-13">تم الرد</span>
                                        @break
                                    @case('archived')
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1.5 fs-13">مؤرشفة</span>
                                        @break
                                @endswitch
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Sender Quick Details -->
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-4">
                                <div class="avatar-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 50px; height: 50px;">
                                    {{ strtoupper(mb_substr($contactMessage->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">{{ $contactMessage->name }}</h6>
                                    <div class="d-flex flex-wrap gap-3 fs-13 text-muted">
                                        <span><i class="fas fa-envelope me-1"></i> {{ $contactMessage->email }}</span>
                                        @if($contactMessage->phone)
                                        <span class="dir-ltr"><i class="fas fa-phone me-1"></i> {{ $contactMessage->phone }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Message Content -->
                            <h6 class="fw-bold text-dark fs-14 mb-2">نص الرسالة:</h6>
                            <div class="p-3.5 rounded-3 bg-body-tertiary border text-dark fs-15 leading-relaxed white-space-pre-line mb-4">
                                {{ $contactMessage->message }}
                            </div>

                            <!-- Reply Quick Button -->
                            <div class="d-flex gap-2">
                                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject ?? 'رواد البرمجة') }}" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">
                                    <i class="fas fa-reply me-1"></i> الرد عبر البريد الإلكتروني
                                </a>
                                @if($contactMessage->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" target="_blank" class="btn btn-success rounded-3 px-4 fw-bold shadow-sm">
                                    <i class="fab fa-whatsapp me-1"></i> مراسلة عبر الواتساب
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Status & Admin Notes -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-transparent border-bottom p-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-tasks text-primary me-2"></i> إدارة حالة الرسالة</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.contact-messages.update', $contactMessage->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Status Dropdown -->
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-bold text-dark fs-14">حالة الرسالة <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select rounded-3 p-2.5 @error('status') is-invalid @enderror" required>
                                        <option value="new" {{ old('status', $contactMessage->status) === 'new' ? 'selected' : '' }}>جديدة (New)</option>
                                        <option value="read" {{ old('status', $contactMessage->status) === 'read' ? 'selected' : '' }}>مقروءة (Read)</option>
                                        <option value="replied" {{ old('status', $contactMessage->status) === 'replied' ? 'selected' : '' }}>تم الرد (Replied)</option>
                                        <option value="archived" {{ old('status', $contactMessage->status) === 'archived' ? 'selected' : '' }}>مؤرشفة (Archived)</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Admin Notes -->
                                <div class="mb-4">
                                    <label for="admin_notes" class="form-label fw-bold text-dark fs-14">ملاحظات الإدارة الداخلية</label>
                                    <textarea name="admin_notes" id="admin_notes" rows="5" class="form-control rounded-3 p-3 @error('admin_notes') is-invalid @enderror" placeholder="سجل ملاحظاتك الخاصة للرد أو متابعة العميل...">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                                    <small class="text-muted fs-12">هذه الملاحظات خاصة بك ولا يراها العميل</small>
                                    @error('admin_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary rounded-3 w-100 py-2.5 fw-bold shadow-sm">
                                    <i class="fas fa-save me-2"></i> حفظ التحديثات
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
