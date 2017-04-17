<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

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
    protected $fillable = ['tax_id', 'name', 'comercial_name', 'description', 'phone', 'email', 'website', 'address', 'city_id', 'department', 'img_url', 'valid'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }      

    public function offices() 
    {
        return $this->hasMany('App\Office');
    }

    public function catalogs() 
    {
        return $this->hasMany('App\Catalog');
    }

    public function profiles()
    {
        return $this->hasMany('App\Profile');
    }

    public function orders() 
    {
        return $this->hasMany('App\Order');
    }

    public function documentNumber() 
    {
        return $this->hasOne('App\DocumentNumber');
    }
}
