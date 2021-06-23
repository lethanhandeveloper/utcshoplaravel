<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamps = false;
    protected $guarded = [];

    public static function getNewProduct(Type $var = null)
    {
        $products = Product::orderByDesc('id') ->limit(8)->get();  
        return $products;
    }

    public static function getHotProduct(Type $var = null)
    {
        $products = Product::orderByDesc('sold')->limit(8)->get();    
        return $products;
    }
}
