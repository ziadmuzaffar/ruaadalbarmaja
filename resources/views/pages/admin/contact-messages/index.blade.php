@extends('layouts.admin.app')

@section('title', 'رسائل التواصل - رواد البرمجة')

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
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1"><i class="fas fa-envelope-open-text text-warning me-2"></i> صندوق الرسائل والتنبيهات</h4>
                    <p class="text-muted fs-14 mb-0">استعرض واستجب لرسائل العملاء الواردة من نموذج الاتصال بالموقع</p>
                </div>
                <div>
                    <form action="{{ route('admin.contact-messages.mark-all-read') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary rounded-3 px-3 py-2 fw-semibold">
                            <i class="fas fa-check-double me-1"></i> تحديد الكل كمقروء
                        </button>
                    </form>
                </div>
            </div>

            <!-- Messages Table Card -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <th class="ps-4">المرسل</th>
                                    <th>الموضوع</th>
                                    <th>معلومات الاتصال</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                    <th class="pe-4 text-end">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $message)
                                @php
                                $isNew = ($message->status === 'new');
                                @endphp
                                <tr class="{{ $isNew ? 'table-warning bg-opacity-10 fw-medium' : '' }}">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-circle rounded-circle {{ $isNew ? 'bg-warning text-dark' : 'bg-light text-secondary' }} d-flex align-items-center justify-content-center fw-bold fs-14" style="width: 40px; height: 40px;">
                                                {{ strtoupper(mb_substr($message->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark fs-14">{{ $message->name }}</div>
                                                @if($isNew)
                                                <span class="badge bg-warning text-dark rounded-pill px-2 py-0.5 fs-11">جديدة</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-semibold fs-14 text-truncate" style="max-width: 250px;">{{ $message->subject ?? 'بدون عنوان' }}</div>
                                        <small class="text-muted fs-12 text-truncate d-block" style="max-width: 250px;">{{ Str::limit($message->message, 50) }}</small>
                                    </td>
                                    <td>
                                        <div class="fs-13 text-dark"><i class="fas fa-envelope text-muted me-1"></i> {{ $message->email }}</div>
                                        @if($message->phone)
                                        <div class="fs-13 text-muted dir-ltr text-end"><i class="fas fa-phone text-muted me-1"></i> {{ $message->phone }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($message->status)
                                            @case('new')
                                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-1 fs-12">جديدة</span>
                                                @break
                                            @case('read')
                                                <span class="badge bg-info-subtle text-info rounded-pill px-3 py-1 fs-12">مقروءة</span>
                                                @break
                                            @case('replied')
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fs-12">تم الرد</span>
                                                @break
                                            @case('archived')
                                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 fs-12">مؤرشفة</span>
                                                @break
                                            @default
                                                <span class="badge bg-light text-muted rounded-pill px-3 py-1 fs-12">{{ $message->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="text-muted fs-13">{{ $message->created_at ? $message->created_at->format('Y-m-d H:i') : '-' }}</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-1">
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-sm btn-light rounded-circle text-primary" title="عرض وحفظ ملاحظات"><i class="fas fa-eye"></i></a>
                                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت تأكد من رغبتك في حذف هذه الرسالة؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light rounded-circle text-danger" title="حذف"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fs-1 mb-3 opacity-40"></i>
                                            <h5>صندوق الرسائل فارغ</h5>
                                            <p class="fs-14">لم يتم استلام أي رسائل اتصال جديدة حتى الآن</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($messages->hasPages())
                <div class="card-footer bg-transparent border-0 p-3">
                    {{ $messages->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
