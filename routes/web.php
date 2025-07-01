<?php

use App\Http\Controllers\AddProducts;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/',function(){return view('welcome');});
Route::get('/menu', [MainController::class, 'index'])->name('menu.index');
Route::post('/menu/add-to-cart/{id}', [MainController::class, 'addToCart'])->name('menu.addToCart');
Route::get('/cart', [MainController::class, 'showCart'])->name('cart.show');
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('cart.checkout');
Route::get('/menu/finish/{id}', [MainController::class, 'finish'])->name('orders.finish');
Route::get('/menu/print/{id}', [MainController::class, 'printOrder'])->name('orders.print');
Route::delete('/cart/remove/{id}', [MainController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/increase/{id}', [MainController::class, 'increaseQuantity'])->name('cart.increase');
Route::get('/cart/decrease/{id}', [MainController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::get('/cart/remove/{id}', [MainController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/admin/customer-status', [MainController::class, 'customerCountStatus'])->name('admin.customer-status');

require __DIR__.'/auth.php';
Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cash', [MainController::class, 'cash'])->name('cash');
Route::put('/orders/{id}/mark-paid', [MainController::class, 'markAsPaid'])->name('orders.markPaid');
Route::post('/post', [MainController::class, 'store'])->name('register.post');
Route::get('/tambahakun', [MainController::class,'register'])->name('tambah');
Route::get('/tambahmenu', [ProductController::class, 'index'])->name('addmenu');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/listmenu', [ProductController::class, 'show'])->name('listmenu');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});