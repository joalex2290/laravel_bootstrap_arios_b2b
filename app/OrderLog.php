<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_logs';

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
    protected $fillable = ['order_id', 'comment', 'attachment_type', 'attachment', 'from', 'to'];

    public function order() 
    {
        return $this->belongsTo('App\Order');
    }
    
}
