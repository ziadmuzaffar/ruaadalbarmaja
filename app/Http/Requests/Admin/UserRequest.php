<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }
    // Check Validate
    private function onValidate() {
        if (request()->isMethod('PUT')) {
            return ['password' => 'nullable|confirmed'];
        } else {
            return ['password' => 'required|confirmed'];
        }
    }
    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            ...$this->onValidate()
        ];
    }
    // Messages
    public function messages()
    {
        $required = 'هذا الحقل مطلوب';
        $unique = 'هذا الحقل موجود سابقا';
        $email = 'يجب ان يكون صحيح';
        $confirmed = 'كلمة المرور غير متطابقة';
        return [
            'full_name.required' => $required,
            'email.required' => $required,
            'email.unique' => $unique,
            'email.email' => $email,
            'password.required' => $required,
            'password.confirmed' => $confirmed,
            'password_confirmation.required' => $required,
        ];
    }
}
