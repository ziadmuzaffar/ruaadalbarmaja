<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الشريك مطلوب',
            'name.string' => 'اسم الشريك يجب أن يكون نصاً',
            'name.max' => 'اسم الشريك يجب ألا يتجاوز 255 حرفاً',
            'website.url' => 'رابط الموقع الإلكتروني يجب أن يكون رابطاً صحيحاً (مثال: https://example.com)',
            'website.max' => 'رابط الموقع الإلكتروني يجب ألا يتجاوز 255 حرفاً',
            'description.string' => 'الوصف يجب أن يكون نصاً',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, webp',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 10 ميجابايت',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_active.boolean' => 'حالة الشريك يجب أن تكون مفعل أو معطل',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم الشريك',
            'website' => 'موقع الشريك الإلكتروني',
            'description' => 'الوصف',
            'image' => 'شعار / صورة الشريك',
            'order' => 'الترتيب',
            'is_active' => 'الحالة',
        ];
    }
}
