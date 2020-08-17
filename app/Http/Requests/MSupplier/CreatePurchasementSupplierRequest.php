<?php

namespace App\Http\Requests\MSupplier;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchasementSupplierRequest extends FormRequest
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
            'pch_code' => 'required|unique:purchasement_suppliers',
            'pch_tax'  => 'nullable|numeric',
            'pch_disc' => 'nullable|numeric',
            'pch_ship' => 'nullable|numeric',
            's_id'     => 'required',
            'pch_note' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'pch_code.required' => 'Kode dibutuhkan!',
            'pch_code.unique'   => 'Kode sudah ada!',
            'pch_tax.numeric'   => 'Pajak hanya boleh angka!',
            'pch_disc.numeric'  => 'Diskon hanya boleh angka!',
            'pch_ship.numeric'  => 'Biaya pengiriman hanya boleh angka!',
            's_id.required'     => 'Penyuplai dibutuhkan!'
        ];
    }
}
