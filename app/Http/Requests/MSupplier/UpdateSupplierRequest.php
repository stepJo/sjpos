<?php

namespace App\Http\Requests\MSupplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            's_code'     => 'required',
            's_name'     => 'required',
            's_email'    => 'nullable|email',
            's_contact'  => 'required',
            's_bank'     => 'nullable',
            's_bank_num' => 'nullable|regex:/[0-9 ]+/',
            's_address'  => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            's_code.required'    => 'Kode dibutuhkan !',
            's_name.required'    => 'Nama dibutuhkan !',
            's_email.email'      => 'Email tidak valid !',
            's_contact.required' => 'Kontak dibutuhkan !',
            's_bank_num.regex'   => 'Nomor hanya boleh angka !',
        ];
    }
}
