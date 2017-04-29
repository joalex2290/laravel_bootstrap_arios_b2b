<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotes';

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
    protected $fillable = ['name', 'email', 'phone', 'address', 'department_id', 'city_id', 'organization', 'comment'];

	public function quoteDetails() 
    {
        return $this->hasMany('App\QuoteDetail');
    }

    public function city() 
    {
        return $this->belongsTo('App\City');
    }

}
