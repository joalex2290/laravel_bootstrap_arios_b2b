<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

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
    protected $fillable = ['user_id', 'organization_id', 'personal_id', 'phone', 'cellphone', 'personal_email', 'born_date', 'address', 'city_id', 'img_url'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
    public $timestamps = false;

    public function user() 
     {
        return $this->belongsTo('App\User');
    }

    public function organization() 
    {
        return $this->belongsTo('App\Organization');
    }

    
}
