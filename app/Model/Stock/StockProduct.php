<?php

namespace App\Model\Stock;

use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    protected $table        = 'tbl_stock_product';
    protected $guard_name   = 'web';

    
    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'product_id', 
        'variant_id',
        'variant_detail_id',
        'stock'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
