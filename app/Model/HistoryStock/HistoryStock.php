<?php

namespace App\Model\HistoryStock;

use Illuminate\Database\Eloquent\Model;

class HistoryStock extends Model
{
    protected $table        = 'tbl_history_stock';
    protected $guard_name   = 'web';


    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = [
        'product_id', 
        'variant_detail_id',
        'stock_in',
        'stock_out',
        'current_stock'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
