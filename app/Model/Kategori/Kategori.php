<?php

namespace App\Model\Kategori;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tbl_kategori';
    protected $guard_name = 'web';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'nama_kategori', 
        'keterangan'
    ];

    public static $rules = [
        'nama_kategori' => 'required | string',
        'keterangan' => 'nullable | string'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
