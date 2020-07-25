<?php

namespace App\Http\Requests\MProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'cat_name'    => 'required|unique:categories',
        ];
    }

    public function messages()
    {
        return [
            'cat_name.required' => 'Nama dibutuhkan !',
            'cat_name.unique'   => 'Kategori sudah ada !', 
        ];
    }
}
