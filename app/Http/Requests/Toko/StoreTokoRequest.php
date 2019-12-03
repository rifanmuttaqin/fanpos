<?php

namespace App\Http\Requests\Toko;

use Illuminate\Foundation\Http\FormRequest;

class StoreTokoRequest extends FormRequest
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
            'nama_toko'             => 'required|string',
            'npwp'                  => 'nullable|string',
            'alamat_toko'           => 'required|string',
            'nomor_telfon'          => 'required|string',
            'email'                 => 'required|string',
            'fax'                   => 'nullable|string',
            'website'               => 'nullable|string',
            'kode_pos'              => 'nullable|string',
            'logo_url'              => 'nullable|string',
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
