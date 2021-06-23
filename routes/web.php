<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user/home');
// });

Route::get('/', 'Web\HomeController@index');



Route::post('login', 'Web\AccountController@login');
Route::get('logout', 'Web\AccountController@logout') ->name('logout');
Route::get('sendmail','PaymentController@sendmail');
// Route::resource('login', 'Web\AccountController');
Route::middleware(['AdminRole'])->group(function () {
    Route::get('admin/category/add', function () {
        return view('admin/addcategory');
    });

    Route::resource('admin/category', 'Web\CategoryController');
    Route::resource('admin/product', 'Web\ProductController');
});
