<?php

namespace App\Http\Requests\MApp;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogoRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'image.required'   => 'Logo diperlukan !',
            'image_logo.image' => 'File tidak diijinkan !',
            'image.mimes'      => 'Ekstensi tidak diijinkan !',
            'image.max'        => 'File maksimal 2 MB !',
        ];
    }
}
