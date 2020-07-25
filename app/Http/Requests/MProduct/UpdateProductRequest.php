<?php

namespace App\Http\Requests\MProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
    public function rules(Request $request)
    {

        return [
            'p_code'   => ['required', Rule::unique('products')->where(function($query) use ($request) {
                                return $query->where('p_code', '!=', $request->p_code);
                            })
                          ],
            'cat_id'   => 'required',
            'p_name'   => ['required', Rule::unique('products')->where(function($query) use ($request) {
                                return $query->where('p_name', '!=', $request->p_name);
                            })
                          ],
            'unit_id'  => 'required',
            'p_price'  => 'required|numeric',
            'p_image'  => 'image|mimes:jpeg,jpg,png,gif,svg|max:5048',
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
            'p_price.numeric'   => 'Harga harus angka !',
            'p_image.image'     => 'File tidak diijinkan !',
            'p_image.mimes'     => 'Ekstensi tidak diijinkan !',
            'p_image.max'       => 'File maksimal 5 MB !',
            'p_status.required' => 'Status dibutuhkan !',
        ];
    }
}
