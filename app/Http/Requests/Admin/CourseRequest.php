<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }
    // Validate Image
    private function onValidate() {
        $validate = 'image|mimes:png';
        if (!request()->isMethod('PUT')) {
            $validate .= '|required';
        }
        return $validate;
    }
    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        return [
            'image' => $this->onValidate(),
            'name' => 'required|unique:courses,name,' . $this->id,
            'ordering' => 'required',
            'track_id' => 'required'
        ];
    }

    public function messages()
    {
        $required = 'هذا الحقل مطلوب';
        $unique = 'هذا الحقل موجود سابقا';
        $image = 'يجب أن تكون صورة';
        $mimes = 'يجب أن يكون ملفا من النوع: png';
        return [
            'image.required' => $required,
            'image.image' => $image,
            'image.mimes' => $mimes,
            'name.required' => $required,
            'name.unique' => $unique,
            'ordering' => $required,
            'track_id.required' => $required
        ];
    }
}
