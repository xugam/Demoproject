<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontEndController::class,'index'])->name('index');
Route::get('/about',[FrontEndController::class,'about'])->name('about');
Route::get('/cart',[FrontEndController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontEndController::class,'checkout'])->name('checkout');
Route::get('/products',[FrontEndController::class,'products'])->name('products');
Route::get('/single_product/{id}',[FrontEndController::class,'single_product'])->name('single_product');
Route::post('/add_to_cart',[FrontEndController::class,'add_to_cart'])->name('add_to_cart');


