<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
            "first_name"=>["required","string","max:30","regex:/^[\x{0600}-\x{06FF}]*$/u"],
            "last_name"=>["required","string","max:30","regex:/^[\x{0600}-\x{06FF}]*$/u"],
            "email"=>"required|email|max:40",
            "password"=>"required|string|min:3",
            "city"=>"required|string",
        ];
    }

    public function messages()
    {
        return [
            "first_name.regex"=>"لطفا نام خود را با حروف فارسی وارد کنید.",
            "last_name.regex"=>"لطفا نام خود را با حروف فارسی وارد کنید.",
            //to prevent showing limits
            "*.max"=>":attribute نامعتبر است.",
        ];
    }
    protected function failedValidation(Validator $validator){
        throw (new ValidationException($validator,response()->outputError($validator->errors())));
    }
}
