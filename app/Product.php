<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['category_id','name', 'description','slug', 'origin_price', 'sale_price', 'content', 'status', 'thumbnail'];

    public function category()
    {
    	return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
