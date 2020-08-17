<?php

namespace App\Http\Requests\MSupplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductSupplierRequest extends FormRequest
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
            'ps_name'  => 'required',
            'ps_code'  => 'required',
            'ps_price' => 'required|numeric',
            'ps_desc'  => 'nullable',
            's_id'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ps_name.required'  => 'Nama dibutuhkan!',
            'ps_code.required'  => 'Kode dibutuhkan!',
            'ps_price.required' => 'Harga dibutuhkan!',
            'ps_price.numeric'  => 'Harga hanya boleh angka!',
            's_id.required'     => 'Penyuplai dibutuhkan!'
        ];
    }
}
