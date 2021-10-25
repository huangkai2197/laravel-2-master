<?php

namespace App\Http\Requests\Csl;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class QmchangeRequest extends FormRequest
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
            'class_name'=>'required',
            'teacher'=>'required',
            'teach_operating_condition'=>'required',
            'operating_condition'=>'required',
            'remark'=>'required',
            'info_id'=>'required'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!',$validator->errors()->all(),422)));
    }
}
