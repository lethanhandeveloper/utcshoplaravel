<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('product', 'ProductController');

//api for products
Route::get('product/newproduct', 'ProductController@getNewProduct');
Route::get('product/hotproduct', 'ProductController@getHotProduct');
//api for categories 
Route::get('category', 'CategoryController@index');
//api for accounts

Route::resource('product', 'ProductController');
// api for cart
Route::resource('/cart', 'CartController');

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     Route::resource('/cart', 'CartController');

// });

// Route::group(['middleware' => 'jwt.auth'], function () {
//     Route::post('/login', 'AccountController@login');
// });
Route::post('login', 'AccountController@login');


Route::post('register', 'AccountController@register');
Route::get('comment/product/{id}', 'CommentController@getCommentbyProductId');
Route::post('product/filter', 'ProductController@filterProduct');
Route::get('slide', 'ImageController@getSlide');

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('account', 'AccountController@getAccountData');
    Route::get('logout', 'AccountController@logout');
    Route::get('cart', 'CartController@getCartByUserId');
    Route::get('cart/add/{id}/quantity/{quantity}', 'CartController@addProducttoCart');
    Route::get('cart/delete/{id}', 'CartController@deleteCart');
    Route::get('cart/update/{id}/quantity/{quantity}', 'CartController@updateCart');
    Route::get('cart/delete/{id}', 'CartController@delete');
    Route::get('comment/add/product/{id}/content/{content}', 'CommentController@addComment');
    Route::post('bill/add', 'PaymentController@addBill');
    Route::get('bill/get/status/{status}', 'PaymentController@getBill');
    Route::get('bill/detail/{id}', 'PaymentController@getBillDetail');
});
