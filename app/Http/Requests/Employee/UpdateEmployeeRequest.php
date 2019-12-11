<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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

            'address'               => 'nullable|string',
            'full_name'             => 'nullable|string',
            'profile_picture'       => 'nullable|string',
            'email'                 => 'required|string',
            'nik'                   => 'required|string',
            'jenis_kelamin'         => 'nullable|integer',
            'tempat_lahir'          => 'nullable|string',
            'tanggal_lahir'         => 'nullable|date',
            'agama'                 => 'nullable|integer',
            'status_pernikahan'     => 'nullable|integer',
            'phone'                 => 'required|string',
            'tanggal_masuk'         => 'nullable|date',
            'tipe_karyawan'         => 'nullable|integer',
            'keterangan'            => 'nullable|string',
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
            'email.required' => 'Username tidak boleh dikosongkan',
            'email.email' => 'Format email tidak disetujui',
            'email.unique' => 'Email telah digunakan sebelumnya',

            'full_name.string' => 'Gunakan huruf untuk nama lengkap anda',
            'full_name.min' => 'Gunakan setidaknya 2 karakter',

            'address.string' => 'Gunakan huruf untuk nama lengkap anda',
        ];
    }
}
