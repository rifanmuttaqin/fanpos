<?php

namespace App\Model\Stock;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $table        = 'tbl_stock_history';
    protected $guard_name   = 'web';

    const TYPE_INITIAL_STOCK         = 10;
    const TYPE_ADJUSTMENT            = 20;
    const TYPE_PO                    = 20;

     /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'variant_detail_id', 
        'stock_in',
        'stock_out',
        'current_stock'
    ];

    /**
     *
     * @var array
     */
    public function variantDetail()
    {
        return $this->hasOne('App\Model\Variant\VariantDetail');
    }

}
