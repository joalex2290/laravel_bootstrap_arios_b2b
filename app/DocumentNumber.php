<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentNumber extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'document_numbers';

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
    protected $fillable = ['organization_id', 'current_number', 'next_number'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
     public $timestamps = false;

     public function organization()
     {
        return $this->belongsTo('App\organization');
    }
    
}
