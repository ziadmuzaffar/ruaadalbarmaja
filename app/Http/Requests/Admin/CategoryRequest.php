<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $rawSlug = $this->filled('slug') ? $this->input('slug') : $this->input('name');
        $slug = Str::slug($rawSlug);
        if (empty($slug)) {
            $slug = trim(preg_replace('/[^\p{L}\p{N}]+/u', '-', $rawSlug), '-');
        }

        $this->merge([
            'slug' => $slug,
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : false,
            'order' => $this->filled('order') ? (int) $this->input('order') : 0,
        ]);
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($categoryId)],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم التصنيف مطلوب',
            'name.string' => 'اسم التصنيف يجب أن يكون نصاً',
            'name.max' => 'اسم التصنيف يجب ألا يتجاوز 255 حرفاً',
            'slug.required' => 'الرابط المختصر مطلوب',
            'slug.string' => 'الرابط المختصر يجب أن يكون نصاً',
            'slug.max' => 'الرابط المختصر يجب ألا يتجاوز 255 حرفاً',
            'slug.unique' => 'الرابط المختصر مستخدم بالفعل',
            'description.string' => 'الوصف يجب أن يكون نصاً',
            'icon.string' => 'الأيقونة يجب أن تكون نصاً',
            'icon.max' => 'الأيقونة يجب ألا تتجاوز 255 حرفاً',
            'order.integer' => 'الترتيب يجب أن يكون رقماً صحيحاً',
            'order.min' => 'الترتيب يجب أن يكون صفراً أو أكثر',
            'is_active.boolean' => 'حالة التصنيف يجب أن تكون نعم أو لا',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم التصنيف',
            'slug' => 'الرابط المختصر',
            'description' => 'الوصف',
            'icon' => 'الأيقونة',
            'order' => 'الترتيب',
            'is_active' => 'الحالة',
        ];
    }
}

