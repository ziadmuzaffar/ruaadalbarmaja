<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : false,
            'order' => $this->filled('order') ? (int) $this->input('order') : 0,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الخدمة مطلوب',
            'title.string' => 'عنوان الخدمة يجب أن يكون نصاً',
            'title.max' => 'عنوان الخدمة يجب ألا يتجاوز 255 حرفاً',
            'description.required' => 'وصف الخدمة مطلوب',
            'description.string' => 'وصف الخدمة يجب أن يكون نصاً',
            'icon.string' => 'الأيقونة يجب أن تكون نصاً',
            'icon.max' => 'الأيقونة يجب ألا تتجاوز 255 حرفاً',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_active.boolean' => 'حالة الخدمة يجب أن تكون نعم أو لا',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان الخدمة',
            'description' => 'الوصف',
            'icon' => 'الأيقونة',
            'order' => 'الترتيب',
            'is_active' => 'الحالة',
        ];
    }
}
