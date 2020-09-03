<?php

namespace App\Http\Requests\MUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'u_email'          => 'required|email',
            'u_contact'        => 'required',
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
            'u_contact.required'       => 'Kontak dibutuhkan !',
            'b_id.required'            => 'Cabang dibutuhkan !',
            'role_id.required'         => 'Role dibutuhkan !'
        ];
    }
}
