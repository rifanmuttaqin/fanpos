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
        'harga',
        'stock'
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
