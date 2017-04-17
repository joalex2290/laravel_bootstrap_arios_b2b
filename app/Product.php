<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['code', 'name', 'type', 'category_id', 'reference', 'barcode', 'brand', 'tax', 'package_qty', 'unit_meassure', 'comment', 'img_url'];

     /**
     * Timestamps disabled
     *
     * @var string
     */
    public $timestamps = false;

    public function category() 
    {
        return $this->belongsTo('App\Category');
    }
    
}
