<?php

namespace App\Http\Requests\MSale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\MProduct\Product;

class CreateDiscountProductRequest extends FormRequest
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
        $product = Product::find($request->p_id);

        $price = $product != null ? $product->p_price : 0;

        return [
            'p_id'     => 'required|unique:discount_products',
            'dp_value'  => 'required|numeric|min:1|max:'.$price,
            'dp_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'p_id.required'      => 'Produk dibutuhkan !',
            'p_id.unique'        => 'Diskon produk ini sudah ada !', 
            'dp_value.required'  => 'Diskon dibutuhkan !',
            'dp_value.numeric'   => 'Diskon hanya boleh angka !',
            'dp_value.min'       => 'Diskon tidak boleh minus !',
            'dp_value.max'       => 'Diskon melebihi batas harga !',
            'dp_status.required' => 'Status dibutuhkan !',
        ];
    }
}
