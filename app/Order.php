<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['doc_num', 'user_id', 'user', 'office_id', 'office_name', 'organization_id', 'organization_name', 'catalog_id', 'catalog_name', 'status', 'subtotal', 'tax', 'total', 'total_delivered', 'reference', 'comment', 'address', 'city_id', 'city_name', 'department_name', 'country_name', 'contact_name', 'contact_phone', 'contact_cellphone', 'contact_email', 'seller_id', 'seller_name', 'reviewed_at', 'received_at', 'dispatched_at', 'delivered_at'];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function office() 
    {
        return $this->belongsTo('App\Office');
    }

    public function catalog() 
    {
        return $this->belongsTo('App\Catalog');
    }

    public function city() 
    {
        return $this->belongsTo('App\City');
    }

    public function seller() 
    {
        return $this->belongsTo('App\User','seller_id');
    }

    public function orderDetails() 
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function orderLogs() 
    {
        return $this->hasMany('App\OrderLog');
    }

}
