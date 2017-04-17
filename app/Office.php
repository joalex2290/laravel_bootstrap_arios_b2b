<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offices';

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
    protected $fillable = ['code', 'name', 'type', 'organization_id', 'phone', 'address', 'city_id', 'postal_code', 'contact_name', 'contact_phone', 'contact_cellphone', 'contact_email', 'credit_limit', 'avatar_url', 'active'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
     public $timestamps = false;

     public function organization() 
     {
        return $this->belongsTo('App\Organization');
    }

    public function city() 
    {
        return $this->belongsTo('App\City');
    }

    public function catalogs() 
    {
        return $this->belongsToMany('App\Catalog');
    }

    public function users() 
    {
        return $this->belongsToMany('App\User');
    }

    public function addUser(User $user)
    {
        return $this->users()->save($user);
    }

    public function addCatalog(Catalog $catalog)
    {
        return $this->catalogs()->save($catalog);
    }

    public function orders() 
    {
        return $this->hasMany('App\Order');
    }
    
}
