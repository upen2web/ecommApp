<?php

use App\Http\Controllers\MainController;
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

Route::get('/',[MainController::class, 'index']);
Route::get('cart',[MainController::class, 'cart']);
Route::get('checkout',[MainController::class, 'checkout'])->name('checkout');
Route::get('shop',[MainController::class, 'shop'])->name('shop');
Route::get('shopdetail/{id}',[MainController::class, 'shopdetail']);
Route::get('register',[MainController::class, 'register']);
Route::post('registerUser',[MainController::class, 'registerUser']);
Route::get('login',[MainController::class, 'login']);
Route::post('loginUser',[MainController::class, 'loginUser']);
Route::get('logout',[MainController::class, 'logout']);
Route::post('addCart',[MainController::class, 'addToCart']);
Route::get('deleteCartItem/{id}',[MainController::class, 'deleteCartItem']);
Route::put('{id}/updateCart',[MainController::class, 'updateCart']);
Route::get('checkout',[MainController::class, 'checkout']);