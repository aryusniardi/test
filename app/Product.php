<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    
    protected $fillable = ['product_name', 'product_desc', 'product_price', 'product_image'];

}
