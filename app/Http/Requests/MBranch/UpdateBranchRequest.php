<?php

namespace App\Http\Requests\MBranch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
            'b_code'    => 'required',
            'b_name'    => 'required',
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
            'b_name.required'    => 'Nama dibutuhkan !',
            'b_email.required'   => 'Email dibutuhkan !',
            'b_email.email'      => 'Email tidak valid !',
            'b_contact.required' => 'Kontak dibutuhkan !',
            'b_status'           => 'Status dibutuhkan !'
        ];
    }
}
