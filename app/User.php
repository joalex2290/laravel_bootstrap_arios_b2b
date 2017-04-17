<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function profile() 
    {
        return $this->hasOne('App\Profile');
    }

    public function orders() 
    {
        return $this->hasMany('App\Order');
    }

    public function offices() 
    {
        return $this->belongsToMany('App\Office');
    }

    public function addUserTo(Office $office)
    {
        return $this->offices()->save($office);
    }

}
