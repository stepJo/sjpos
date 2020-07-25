<?php

namespace App\Http\Requests\MSupplier;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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
            's_code'     => 'required|unique:suppliers',
            's_name'     => 'required|unique:suppliers',
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
            's_code.unique'      => 'Kode sudah ada !',
            's_name.required'    => 'Nama dibutuhkan !',
            's_name.unique'      => 'Nama sudah ada !',
            's_email.email'      => 'Email tidak valid !',
            's_contact.required' => 'Kontak dibutuhkan !',
            's_bank_num.regex'   => 'Rekening hanya boleh angka !',
        ];
    }
}
