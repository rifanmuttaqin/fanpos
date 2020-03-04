<?php

namespace App\Model\Variant;

use Illuminate\Database\Eloquent\Model;

class VariantDetail extends Model
{
    protected $table        = 'tbl_variant_detail';
    protected $guard_name   = 'web';

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'variant_id', 
        'option',
        'variant_code',
        'harga_jual',
        'harga_beli'
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
    
    /**
     *
     * @var array
     */
    public function makevariantCode($product_name)
    {
        $characters = $product_name . time();
        $length = 9;

        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }
}
