<?php

namespace App\Model\Satuan;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'tbl_satuan';
    protected $guard_name = 'web';

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'nama_satuan', 
        'simbol_satuan'
    ];

    public static $rules = [
        'nama_satuan' => 'required | string',
        'simbol_satuan' => 'required | string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
