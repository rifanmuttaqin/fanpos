<?php

namespace App\Model\Toko;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table 		= 'tbl_toko';
    protected $guard_name 	= 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_toko', 
        'npwp',
        'alamat_toko',
        'nomor_telfon',
        'email',
        'fax',
        'website',
        'kode_pos',
        'logo_url'
    ];

    public static $rules = [
        'nama_toko' 	=> 'required | string',
        'npwp' 			=> 'nullable | string',
        'alamat_toko' 	=> 'required | string',
        'nomor_telfon' 	=> 'required | string',
        'email' 		=> 'required | string',
        'fax' 			=> 'nullable | string',
        'website' 		=> 'nullable | string',
        'kode_pos' 		=> 'nullable | string',
        'logo_url' 		=> 'nullable | string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
