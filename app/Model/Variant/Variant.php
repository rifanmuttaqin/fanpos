<?php

namespace App\Model\Variant;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table        = 'tbl_variant';
    protected $guard_name   = 'web';

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'product_id', 
        'nama_variant'
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
    public function product()
    {
        return $this->hasOne('App\Model\Product\Product');
    }

    /**
     *
     */
    public static function findByProduct($product_id)
    {
        return static::where('product_id',$product_id)->first();
    }

    /**
     *
     * @var array
     */
    public function variantDetail()
    {
        return $this->hasMany('App\Model\Variant\VariantDetail');
    }
}
