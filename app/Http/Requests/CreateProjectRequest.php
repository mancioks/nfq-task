<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'project_title' => 'required|unique:projects,name',
            'number_of_groups' => 'required|numeric|min:1|max:100',
            'students_per_group' => 'required|numeric|min:1|max:100',
        ];
    }
}
