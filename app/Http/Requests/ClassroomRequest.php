<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'List_Classes.*.name' => 'required',
            'List_Classes.*.name_en' => 'required',
            'List_Classes.*.grade_id' => 'required|numeric',

        ];
    }


    public function messages()
    {
        return [
            'List_Classes.*.name.required' => 'اسم الصف بالعربية مطلوب',
            'List_Classes.*.name_en.required' => 'اسم الصف بالانجليزية مطلوب',
            'List_Classes.*.grade_id.required' => 'المرحلة الدراسية مطلوبة',
            'List_Classes.*.grade_id.numeric' => 'هذه القيمة خاطئه',
        ];
    }
}
