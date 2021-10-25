<?php

namespace App\Http\Requests\student;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddLabrunRequest extends FormRequest
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
            'laboratory_id'=>'required',
            'week'=>'required',
            'time'=>'required',
            'class_id'=>'required',
            'number'=>'required',
            'class_name'=>'required',
            'class_type'=>'required',
            'teacher'=>'required',
            'situation'=>'required',
            'remark'=>'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!',$validator->errors()->all(),422)));
    }
}
