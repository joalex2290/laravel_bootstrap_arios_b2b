<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['line', 'order_id', 'product_id', 'product_code', 'product_name', 'quantity', 'approved_quantity', 'open_quantity', 'price', 'tax_prct', 'tax', 'price_tax', 'status'];

    public function order() 
    {
        return $this->belongsTo('App\Order');
    }

    public function product() 
    {
        return $this->belongsTo('App\Product');
    }
    
}
