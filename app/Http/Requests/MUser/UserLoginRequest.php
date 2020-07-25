<?php

namespace App\Http\Requests\MUser;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'u_email'    => 'required',
            'u_password' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'u_email.required'    => 'Email dibutuhkan !',
            'u_password.required' => 'Password dibutuhkan !', 
        ];
    }

}
