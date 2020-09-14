<?php

namespace App\Http\Requests\MProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'p_code'   => 'required|unique:products',
            'cat_id'   => 'required',
            'p_name'   => 'required|unique:products',
            'unit_id'  => 'required',
            'p_price'  => 'required|numeric',
            'image'    => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'p_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'p_code.required'   => 'Kode dibutuhkan !',
            'p_code.unique'     => 'Kode sudah ada !', 
            'cat_id.required'   => 'Kategori dibutuhkan!',
            'p_name.required'   => 'Nama dibutuhkan !',
            'p_name.unique'     => 'Nama sudah ada !',
            'unit_id.required'  => 'Satuan dibutuhkan !',
            'p_price.required'  => 'Harga dibutuhkan !',
            'p_price.numeric'   => 'Harga hanya boleh angka !',
            'image.required'    => 'Gambar diperlukan !',
            'image.image'       => 'File tidak diijinkan !',
            'image.mimes'       => 'Ekstensi tidak diijinkan !',
            'image.max'         => 'File maksimal 2 MB !',
            'p_status.required' => 'Status dibutuhkan !',
        ];
    }
}
