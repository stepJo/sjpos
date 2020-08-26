<?php

namespace App\Http\Requests\MUser;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'role_name' => 'required|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'Nama dibutuhkan !',
            'role_name.unique'   => 'Nama sudah ada !',
        ];
    }
}
