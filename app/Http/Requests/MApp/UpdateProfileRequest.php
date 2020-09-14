<?php

namespace App\Http\Requests\MApp;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'app_name'    => 'required',
            'app_email'   => 'required|email',
            'app_contact' => 'nullable',
            'app_contact' => 'nullable',
            'app_address' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'app_name.required'  => 'Nama dibutuhkan !',
            'app_email.required' => 'Email dibutuhkan !',
            'app_email.email'    => 'Email tidak valid !',
        ];
    }
}
