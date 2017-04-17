<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalogs';

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
    protected $fillable = ['code', 'name', 'organization_id', 'valid_from', 'valid_to', 'value'];

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

    public function offices()
    {
        return $this->belongsToMany('App\Office');
    }

    public function addCatalogTo(Office $office)
    {
        return $this->offices()->save($office);
    }

    public function products() 
    {
        return $this->belongsToMany('App\Product')->withPivot('product_code','product_name', 'product_price');
    }

    public function addProduct(Product $product, $code, $name, $price)
    {
        return $this->products()->save($product,['product_code' => $code, 'product_name' => $name, 'product_price' => $price]);
    }
    
}
