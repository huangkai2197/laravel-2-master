<?php

namespace App\Http\Requests\student;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EquipmentBorrowUpdateRequest extends FormRequest
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
            'form_id'=>'required',
            'borrow_department'=>'required',
            'borrow_application'=>'required',
            'destine_start_time'=>'required',
            'destine_end_time'=>'required',
            'borrower_name'=>'required',
            'borrower_phone'=>'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!',$validator->errors()->all(),422)));
    }

}
