<?php

namespace App\Http\Requests;

use App\Traits\ReturnResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    use ReturnResponser;

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
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorvalidator($validator->errors()->first()));
    }
}
