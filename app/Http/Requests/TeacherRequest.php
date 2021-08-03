<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email'             => 'required|unique:teachers,email,' . $this->id,
            //'email'             => ['required', Rule::unique('teachers')->ignore($this->id)],
            'password'          => 'required',
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'specialisation_id' => 'required',
            'gender_id'         => 'required',
            'joining_date'      => 'required|date|date_format:Y-m-d',
            'address'           => 'required',
        ];
    }


    public function messages()
    {
        return [
            'email.required'            => trans('validation.required'),
            'email.unique'              => trans('validation.unique'),
            'password.required'         => trans('validation.required'),
            'name_ar.required'          => trans('validation.required'),
            'name_en.required'          => trans('validation.required'),
            'specialisation_id.required'=> trans('validation.required'),
            'gender_id.required'        => trans('validation.required'),
            'joining_date.required'     => trans('validation.required'),
            'address.required'          => trans('validation.required'),
        ];
    }
}
