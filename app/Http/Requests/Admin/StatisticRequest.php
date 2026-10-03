<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required_if:type,manual', 'nullable', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'type' => ['required', 'in:manual,auto'],
            'source_model' => ['required_if:type,auto', 'nullable', 'string', 'max:255'],
            'calculation_method' => ['required_if:type,auto', 'nullable', 'in:count,sum,avg'],
            'suffix' => ['nullable', 'string', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب',
            'title.string' => 'العنوان يجب أن يكون نصاً',
            'title.max' => 'العنوان يجب ألا يتجاوز 255 حرفاً',
            'value.required_if' => 'القيمة مطلوبة للإحصائيات اليدوية',
            'value.string' => 'القيمة يجب أن تكون نصاً',
            'value.max' => 'القيمة يجب ألا تتجاوز 255 حرفاً',
            'label.required' => 'التسمية مطلوبة',
            'label.string' => 'التسمية يجب أن تكون نصاً',
            'label.max' => 'التسمية يجب ألا تتجاوز 255 حرفاً',
            'icon.string' => 'الأيقونة يجب أن تكون نصاً',
            'icon.max' => 'الأيقونة يجب ألا تتجاوز 255 حرفاً',
            'order.required' => 'الترتيب مطلوب',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_active.boolean' => 'حالة التفعيل يجب أن تكون صحيحة أو خاطئة',
            'type.required' => 'نوع الإحصائية مطلوب',
            'type.in' => 'نوع الإحصائية يجب أن يكون يدوي أو تلقائي',
            'source_model.required_if' => 'مصدر البيانات مطلوب للإحصائيات التلقائية',
            'calculation_method.required_if' => 'طريقة الحساب مطلوبة للإحصائيات التلقائية',
            'calculation_method.in' => 'طريقة الحساب يجب أن تكون count أو sum أو avg',
            'suffix.max' => 'اللاحقة يجب ألا تتجاوز 10 أحرف',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : false,
            'order' => $this->filled('order') ? (int) $this->input('order') : 0,
            'type' => $this->input('type', 'manual'),
            'value' => $this->input('type') === 'auto' ? '0' : $this->input('value'),
        ]);
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان الإحصائية',
            'value' => 'القيمة',
            'label' => 'التسمية',
            'icon' => 'الأيقونة',
            'order' => 'الترتيب',
            'is_active' => 'الحالة',
            'type' => 'نوع الإحصائية',
            'source_model' => 'مصدر البيانات',
            'calculation_method' => 'طريقة الحساب',
            'suffix' => 'اللاحقة',
        ];
    }
}
