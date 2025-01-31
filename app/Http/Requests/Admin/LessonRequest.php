<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'ordering' => 'required',
            'name' => 'required',
            'course_id' => 'required',
            'url' => 'required|url|unique:lessons,url,'.$this->id
        ];
    }
    // Messages
    public function messages()
    {
        $required = 'هذا الحقل مطلوب';
        $unique = 'هذا الحقل موجود سابقا';
        $url = 'يجب ان يكون عنوان Url صحيح';
        return [
            'ordering.required' => $required,
            'name.required' => $required,
            'course_id.required' => $required,
            'url.required' => $required,
            'url.url' => $url,
            'url.unique' => $unique
        ];
    }
}
