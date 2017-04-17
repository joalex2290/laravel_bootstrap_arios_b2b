<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

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
    protected $fillable = ['code', 'name', 'department_id'];

    /**
    * Timestamps disabled
    *
     @var string
    */
    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Department');
    }  
}
