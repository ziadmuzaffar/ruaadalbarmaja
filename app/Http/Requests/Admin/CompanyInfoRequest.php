<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : false,
            'is_maintenance' => $this->has('is_maintenance') ? $this->boolean('is_maintenance') : false,
            'show_hero_section' => $this->has('show_hero_section') ? $this->boolean('show_hero_section') : false,
            'show_about_section' => $this->has('show_about_section') ? $this->boolean('show_about_section') : false,
            'show_services_section' => $this->has('show_services_section') ? $this->boolean('show_services_section') : false,
            'show_statistics_section' => $this->has('show_statistics_section') ? $this->boolean('show_statistics_section') : false,
            'show_projects_section' => $this->has('show_projects_section') ? $this->boolean('show_projects_section') : false,
            'show_testimonials_section' => $this->has('show_testimonials_section') ? $this->boolean('show_testimonials_section') : false,
            'show_partners_section' => $this->has('show_partners_section') ? $this->boolean('show_partners_section') : false,
            'show_contact_section' => $this->has('show_contact_section') ? $this->boolean('show_contact_section') : false,
            'founded_year' => $this->filled('founded_year') ? (int) $this->input('founded_year') : date('Y'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'about' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street' => 'nullable|string|max:255',
            'founded_year' => 'required|integer|min:1900|max:'.date('Y'),
            'working_hours' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'is_maintenance' => 'boolean',
            'maintenance_title' => 'nullable|string|max:255',
            'maintenance_message' => 'nullable|string',
            'maintenance_ends_at' => 'nullable|date',
            'show_hero_section' => 'boolean',
            'show_about_section' => 'boolean',
            'show_services_section' => 'boolean',
            'show_statistics_section' => 'boolean',
            'show_projects_section' => 'boolean',
            'show_testimonials_section' => 'boolean',
            'show_partners_section' => 'boolean',
            'show_contact_section' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'اسم الشركة',
            'description' => 'الوصف المختصر',
            'about' => 'نبذة عن الشركة',
            'logo' => 'الشعار',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'whatsapp' => 'رقم الواتساب',
            'address' => 'العنوان',
            'city' => 'المدينة',
            'district' => 'الحي',
            'street' => 'الشارع',
            'founded_year' => 'سنة التأسيس',
            'working_hours' => 'أوقات العمل',
            'facebook_url' => 'رابط Facebook',
            'twitter_url' => 'رابط Twitter',
            'linkedin_url' => 'رابط LinkedIn',
            'instagram_url' => 'رابط Instagram',
            'tiktok_url' => 'رابط TikTok',
            'is_active' => 'الحالة',
            'is_maintenance' => 'وضع الصيانة',
            'maintenance_title' => 'عنوان صفحة الصيانة',
            'maintenance_message' => 'رسالة الصيانة',
            'maintenance_ends_at' => 'موعد انتهاء الصيانة',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'حقل :attribute مطلوب',
            'string' => 'حقل :attribute يجب أن يكون نصاً',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفاً',
            'email' => 'حقل :attribute يجب أن يكون بريداً إلكترونياً صحيحاً',
            'url' => 'حقل :attribute يجب أن يكون رابطاً صحيحاً',
            'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً',
            'min' => 'حقل :attribute يجب أن يكون :min على الأقل',
            'logo.image' => 'الشعار يجب أن يكون صورة',
            'logo.mimes' => 'الشعار يجب أن يكون من نوع: jpeg, png, jpg, gif',
            'logo.max' => 'حجم الشعار يجب ألا يتجاوز 2 ميجابايت',
            'founded_year.max' => 'سنة التأسيس يجب ألا تتجاوز السنة الحالية',
        ];
    }
}
