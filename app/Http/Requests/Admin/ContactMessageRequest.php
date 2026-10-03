<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:new,read,replied,archived'],
            'admin_notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'الحالة مطلوبة',
            'status.in' => 'الحالة يجب أن تكون إحدى القيم: جديدة، مقروءة، تم الرد، مؤرشفة',
            'admin_notes.string' => 'ملاحظات الإدارة يجب أن تكون نصاً',
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'الحالة',
            'admin_notes' => 'ملاحظات الإدارة',
        ];
    }
}
