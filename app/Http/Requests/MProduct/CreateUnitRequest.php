<?php

namespace App\Http\Requests\MProduct;

use Illuminate\Foundation\Http\FormRequest;

class CreateUnitRequest extends FormRequest
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
            'unit_name'    => 'required|unique:units',
        ];
    }

    public function messages()
    {
        return [
            'unit_name.required' => 'Nama dibutuhkan !',
            'unit_name.unique'   => 'Satuan sudah ada !', 
        ];
    }
}
