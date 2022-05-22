<?php

namespace App\Http\Requests;

use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
            'student_name' => [
                'required',
                Rule::unique('students', 'name')->where('project_id', $this->project_id)
            ],
            'project_id' => 'required|exists:projects,id'
        ];
    }

    public function messages()
    {
        return [
            'student_name.unique' => 'Student exists in current project',
        ];
    }
}
