<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:faculties|min:6|max:32',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Can not be left blank',
            'name.unique' => 'Faculty name already exists',
            'name.min' => 'Faculty name at least 6 characters',
            'name.max' => 'Maximum faculty name 32 characters'
        ];
    }
}
