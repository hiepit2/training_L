<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $data = [
            'email' => 'required|min:6|max:32|unique:students',
        ];

        if ($this->route('student')) {
            // $data['email'] = 'required|min:6|max:32|unique:students,id,' . $this->route('students');  
            $data['email'] = ['required', ValidationRule::unique('students')->ignore($this->route('student'))];
        }

        return $data;

        
    }
}
