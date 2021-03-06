<?php

namespace App\Model\Supplier;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'tbl_supplier';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'alamat',
        'url_profile_pic',
        'nomor_telfon',
        'email'
    ];

    public static $rules = [
        'nama' => 'required | string',
        'alamat' => 'required | string',
        'email' => 'required | string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
