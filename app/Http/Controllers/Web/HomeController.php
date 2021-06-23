<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $new_products = Product::getNewProduct();
        $hot_products = Product::getHotProduct();

        return view('user/home', compact('new_products', 'hot_products'));
    }
}
