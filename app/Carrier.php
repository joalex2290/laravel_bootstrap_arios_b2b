<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carriers';

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
    protected $fillable = ['name', 'label', 'website', 'phone'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
    public $timestamps = false;

    
}
