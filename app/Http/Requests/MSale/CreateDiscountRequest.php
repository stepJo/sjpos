<?php

namespace App\Http\Requests\MSale;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountRequest extends FormRequest
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
            'dis_code'  => 'required|string|unique:discounts',
            'dis_type'  => 'required',
            'min_trans' => 'nullable|numeric',
            'dis_value' => 'required|numeric',
            'dis_qty'   => 'required|numeric',
            'exp_date'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dis_code.required'  => 'Kode dibutuhkan !',
            'dis_code.unique'    => 'Kode sudah ada !', 
            'dis_type.required'  => 'Tipe dibutuhkan !',
            'min_trans.numeric'  => 'Minimal transaksi hanya boleh angka !',
            'dis_value.required' => 'Nilai dibutuhkan!',
            'dis_value.numeric'  => 'Nilai hanya boleh angka !',
            'dis_qty.required'   => 'Jumlah dibutuhkan !',
            'dis_qty.numeric'    => 'Jumlah hanya boleh angka !',
            'exp_date.required'  => 'Tanggal dibutuhkan !',
        ];
    }
}
