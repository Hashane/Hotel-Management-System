<?php

use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\ReservationController;
use App\Http\Controllers\customer\RoomController;
use Illuminate\Support\Facades\Route;

Route::controller(RoomController::class)->group(function () {
    Route::get('/rooms', 'index')->name('rooms.index');
    Route::view('/rooms/{room}', 'customer.rooms.show')->name('rooms.show');
});

Route::view('/', 'customer.index')->name('home');
Route::view('/about', 'customer.about')->name('about');
Route::view('/contact', 'customer.contact')->name('contact');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{room}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::prefix('reservations')
    ->name('reservations.')
    ->controller(ReservationController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{reservation}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('/{reservation}', 'show')->name('show');
        Route::put('/{reservation}', 'update')->name('update');
        Route::delete('/{reservation}', 'destroy')->name('destroy');
    });

Route::view('/confirmation', 'customer.reservations.show')->name('confirmation');
