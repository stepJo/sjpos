<?php

namespace App\Http\Requests\MUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'u_password'       => 'required|min:8|required_with:confirm_password',
            'confirm_password' => 'same:u_password',
        ];
    }

    public function messages()
    {
        return [
            'u_password.required'      => 'Password dibutuhkan !',
            'u_password.min'           => 'Password minimal 8 karakter !',
            'u_password.required_with' => 'Konfirmasi password dibutuhkan !',
            'confirm_password.same'    => 'Password harus sama !',
        ];
    }
}
