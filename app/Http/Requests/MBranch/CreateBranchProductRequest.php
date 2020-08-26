<?php

namespace App\Http\Requests\MBranch;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchProductRequest extends FormRequest
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
            'b_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'b_id.required' => 'Cabang dibutuhkan !',
        ];
    }
}
