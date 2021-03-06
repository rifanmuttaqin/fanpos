<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

class UpdateCustomerRequest extends FormRequest
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
            'nama'              => 'required|string',
            'alamat'            => 'required|string',
            'nomor_telfon'      => 'nullable | string',
            'email'             => 'nullable | string',
            'url_profile_pic'   => 'nullable | string'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
