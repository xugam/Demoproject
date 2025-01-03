<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//FrontEndController
Route::get('/',[FrontEndController::class,'index'])->name('index');
Route::get('/about',[FrontEndController::class,'about'])->name('about');
Route::get('/cart',[FrontEndController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontEndController::class,'checkout'])->name('checkout');
Route::get('/products',[FrontEndController::class,'products'])->name('products');
Route::get('/single_product/{id}',[FrontEndController::class,'single_product'])->name('single_product');
Route::post('/add_to_cart',[FrontEndController::class,'add_to_cart'])->name('add_to_cart');
Route::post('/remove_from_cart',[FrontEndController::class,'remove_from_cart'])->name('remove_from_cart');
Route::post('/edit_cart',[FrontEndController::class,'edit_cart'])->name('edit_cart');
Route::get('/checkout',[FrontEndController::class,'checkout'])->name('checkout');
Route::post('/place_order',[FrontEndController::class,'place_order'])->name('place_order');

//PaymentController
Route::get('/payment',[PaymentController::class,'payment'])->name('payment');
Route::post('/pay',[PaymentController::class,'pay'])->name('pay');
Route::get('/processPayment',[PaymentController::class,'processPayment'])->name('processPayment');
Route::get('/invoice',[PaymentController::class,'invoice'])->name('invoice');

//DashboardController
Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::post('/create',[DashboardController::class,'create'])->name('create');
Route::post('/update',[DashboardController::class,'update'])->name('update');
Route::get('/read',[DashboardController::class,'read'])->name('read');
Route::post('/delete',[DashboardController::class,'delete'])->name('delete');


