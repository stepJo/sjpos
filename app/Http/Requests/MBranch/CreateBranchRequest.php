<?php

namespace App\Http\Requests\MBranch;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'b_code'    => 'required|unique:branches',
            'b_name'    => 'required|unique:branches',
            'b_email'   => 'required|email',
            'b_contact' => 'required',
            'b_desc'    => 'nullable',
            'b_address' => 'nullable',
            'b_status'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'b_code.required'    => 'Kode dibutuhkan !',
            'b_code.unique'      => 'Kode sudah ada !', 
            'b_name.required'    => 'Nama dibutuhkan !',
            'b_name.unique'      => 'Nama sudah ada !',
            'b_email.required'   => 'Email dibutuhkan !',
            'b_email.email'      => 'Email tidak valid !',
            'b_contact.required' => 'Kontak dibutuhkan !',
            'b_status.required'  => 'Status dibutuhkan !'
        ];
    }
}
