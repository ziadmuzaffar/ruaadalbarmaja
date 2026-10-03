<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : false,
            'is_featured' => $this->has('is_featured') ? $this->boolean('is_featured') : false,
            'order' => $this->filled('order') ? (int) $this->input('order') : 0,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'completion_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];

        // عند التحديث، الصورة اختيارية
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'التصنيف مطلوب',
            'category_id.exists' => 'التصنيف المحدد غير موجود',
            'title.required' => 'عنوان المشروع مطلوب',
            'title.string' => 'عنوان المشروع يجب أن يكون نصاً',
            'title.max' => 'عنوان المشروع يجب ألا يتجاوز 255 حرفاً',
            'description.required' => 'الوصف مطلوب',
            'description.string' => 'الوصف يجب أن يكون نصاً',
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, webp',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 10 ميجابايت',
            'client_name.string' => 'اسم العميل يجب أن يكون نصاً',
            'client_name.max' => 'اسم العميل يجب ألا يتجاوز 255 حرفاً',
            'completion_date.date' => 'تاريخ الإنجاز يجب أن يكون تاريخاً صحيحاً',
            'location.string' => 'الموقع يجب أن يكون نصاً',
            'location.max' => 'الموقع يجب ألا يتجاوز 255 حرفاً',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_featured.boolean' => 'حالة المشروع المميز يجب أن تكون نعم أو لا',
            'is_active.boolean' => 'حالة المشروع يجب أن تكون نعم أو لا',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'التصنيف',
            'title' => 'عنوان المشروع',
            'description' => 'الوصف',
            'image' => 'الصورة',
            'client_name' => 'اسم العميل',
            'completion_date' => 'تاريخ الإنجاز',
            'location' => 'الموقع',
            'order' => 'الترتيب',
            'is_featured' => 'مشروع مميز',
            'is_active' => 'الحالة',
        ];
    }
}

