<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
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
     * @return array
     */
    public function rules() 
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'grade_id' => 'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'اسم الصف بالعربية مطلوب',
            'name_en.required' => 'اسم الصف بالانجليزية مطلوب',
            'grade_id.required' => 'المرحلة الدراسية مطلوبة',
            'grade_id.numeric' => 'هذه القيمة خاطئه',
        ];
    }


}
