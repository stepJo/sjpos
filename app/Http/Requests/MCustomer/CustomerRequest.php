<?php

namespace App\Http\Requests\MCustomer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'c_name'    => 'required',
            'c_email'   => 'nullable|email',
            'c_contact' => 'nullable',
            'c_address' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'c_name.required' => 'Nama dibutuhkan !',
            'c_email.email'   => 'Email tidak valid !' 
        ];
    }
}
