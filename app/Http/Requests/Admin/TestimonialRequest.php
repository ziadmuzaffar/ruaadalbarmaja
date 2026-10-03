<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'rating' => $this->filled('rating') ? (int) $this->input('rating') : 5,
        ]);
    }

    public function rules(): array
    {
        $rules = [
            'client_name' => ['required', 'string', 'max:255'],
            'client_position' => ['nullable', 'string', 'max:255'],
            'client_company' => ['nullable', 'string', 'max:255'],
            'testimonial' => ['required', 'string'],
            'client_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['client_image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'client_name.required' => 'اسم العميل مطلوب',
            'client_name.string' => 'اسم العميل يجب أن يكون نصاً',
            'client_name.max' => 'اسم العميل يجب ألا يتجاوز 255 حرفاً',
            'client_position.string' => 'المسمى الوظيفي يجب أن يكون نصاً',
            'client_position.max' => 'المسمى الوظيفي يجب ألا يتجاوز 255 حرفاً',
            'client_company.string' => 'اسم الشركة يجب أن يكون نصاً',
            'client_company.max' => 'اسم الشركة يجب ألا يتجاوز 255 حرفاً',
            'testimonial.required' => 'نص الشهادة / الرأي مطلوب',
            'testimonial.string' => 'نص الشهادة يجب أن يكون نصاً',
            'client_image.image' => 'الملف يجب أن يكون صورة',
            'client_image.mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif, webp',
            'client_image.max' => 'حجم الصورة يجب ألا يتجاوز 10 ميجابايت',
            'rating.required' => 'التقييم مطلوب',
            'rating.integer' => 'التقييم يجب أن يكون رقماً صحيحاً',
            'rating.min' => 'التقييم يجب ألا يقل عن 1',
            'rating.max' => 'التقييم يجب ألا يزيد عن 5',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_active.boolean' => 'حالة الشهادة يجب أن تكون نعم أو لا',
        ];
    }

    public function attributes(): array
    {
        return [
            'client_name' => 'اسم العميل',
            'client_position' => 'المسمى الوظيفي',
            'client_company' => 'اسم الشركة / الجهة',
            'testimonial' => 'نص الشهادة',
            'client_image' => 'صورة العميل',
            'rating' => 'التقييم',
            'order' => 'الترتيب',
            'is_active' => 'الحالة',
        ];
    }
}
