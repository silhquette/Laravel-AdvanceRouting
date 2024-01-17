<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Tip 1 : Route::get() BEFORE Route::resource()
Route::get('product/promo', [ProductController::class, "promo"])->middleware('throttle:1,1');
Route::resource('product', ProductController::class);

// Tip 2 : Group in Another Group
Route::group(['middleware' => ['auth', 'throttle:1,1']], function() {
    
    // '/user/XXX' : In addition to "auth", this group will have middleware "user"
    Route::group(['middleware' => ['manager'], 'prefix' => 'manager'], function() {
        Route::resource('wishlist', WishlistController::class);
    });

    // '/admin/XXX' : This group won't have "user", but will have "auth" and "admin"
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
        Route::resource('users', UserController::class);
    });
});