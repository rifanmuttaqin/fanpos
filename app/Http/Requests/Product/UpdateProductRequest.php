<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'nama_product'          => 'required|string',
            'sku'                   => 'nullable|string',
            'berat'                 => 'nullable|integer',
            'satuan_id'             => 'required|integer',
            'kategori_id'           => 'required|integer',
            'volume'                => 'nullable|numeric',
            'exp'                   => 'nullable|date',
            'merek'                 => 'nullable|string',
            'deskripsi'             => 'nullable|string',
            'single_harga_beli'     => 'nullable|numeric',
            'single_harga_jual'     => 'nullable|numeric',
            'deskripsi'             => 'nullable|string',
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
