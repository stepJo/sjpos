<?php

namespace App\Http\Requests\MSale;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
            'dis_code'  => 'required|string',
            'dis_type'  => 'required',
            'dis_value' => 'required|numeric',
            'dis_qty'   => 'required|numeric',
            'exp_date'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dis_code.required'  => 'Kode dibutuhkan !',
            'dis_type.required'  => 'Tipe dibutuhkan !',
            'dis_value.required' => 'Nilai dibutuhkan!',
            'dis_value.numeric'  => 'Nilai hanya boleh angka !',
            'dis_qty.required'   => 'Jumlah dibutuhkan !',
            'dis_qty.numeric'    => 'Jumlah hanya boleh angka !',
            'exp_date.required'  => 'Tanggal dibutuhkan !',
        ];
    }
}
