<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table        = 'tbl_product';
    protected $guard_name   = 'web';

    const PRODUCT_HAS_VARIANT       = 10;
    const PRODUCT_HAS_NOT_VARIANT   = 20;

    const PRODUCT_HAS_GROSIR        = 10;
    const PRODUCT_HAS_NOT_GROSIR    = 20;

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'nama_product', 
        'sku',
        'berat',
        'volume',
        'has_varian',
        'has_grosir',
        'exp',
        'deskripsi',
        'kategori_id',
        'satuan_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     *
     * @var array
     */
    public function variant()
    {
        return $this->hasOne('App\Model\Variant\Variant');
    }
}
