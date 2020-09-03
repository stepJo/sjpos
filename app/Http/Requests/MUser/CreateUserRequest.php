<?php

namespace App\Http\Requests\MUser;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'u_name'           => 'required',
            'u_email'          => 'required|email|unique:users',
            'u_contact'        => 'required',
            'u_password'       => 'required|min:8|required_with:confirm_password',
            'confirm_password' => 'same:u_password',
            'b_id'             => 'required',
            'role_id'          => 'required',

        ];
    }

    public function messages()
    {
        return [
            'u_name.required'          => 'Nama dibutuhkan !',
            'u_email.required'         => 'Email dibutuhkan !',
            'u_email.email'            => 'Email tidak valid !',
            'u_email.unique'           => 'Email sudah digunakan !',
            'u_contact.required'       => 'Kontak dibutuhkan !',
            'u_password.required'      => 'Password dibutuhkan !',
            'u_password.min'           => 'Password minimal 8 karakter !',
            'u_password.required_with' => 'Konfirmasi password dibutuhkan !',
            'confirm_password.same'    => 'Password harus sama !',
            'b_id.required'            => 'Cabang dibutuhkan !',
            'role_id.required'         => 'Role dibutuhkan !'
        ];
    }
}
