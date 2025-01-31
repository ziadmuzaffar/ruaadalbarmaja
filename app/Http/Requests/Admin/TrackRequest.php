<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }
    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        return [
            'icon' => 'required',
            'name' => 'required|unique:tracks,name,' . $this->id
        ];
    }

    public function messages()
    {
        $required = 'هذا الحقل مطلوب';
        $unique = 'هذا الحقل موجود سابقا';
        return [
            'icon.required' => $required,
            'name.unique' => $unique
        ];
    }
}
