<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table        = 'tbl_product_image';
    protected $guard_name   = 'web';

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'product_id',
        'image_url' 
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
        return $this->hasOne('App\Model\Product\Product');
    }
}
