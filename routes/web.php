<?php

use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('admin/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/cart','admin.cart.index')->name('cart.index');
    Route::view('/reservations','admin.reservations.index')->name('reservations.index');
    Route::view('/reservations/create','admin.reservations.create')->name('reservations.create');

});

require __DIR__.'/auth.php';

Route::controller(RoomController::class)->group(function (){
    Route::get('/rooms', 'index')->name('rooms.index');
    Route::view('/room-details', 'customer.rooms.show')->name('rooms.show');
});

Route::view('/', 'customer.index')->name('home');
Route::view('/about', 'customer.about')->name('about');
//Route::view('/cart', 'customer.cart')->name('cart');


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
        Route::post('/store', 'store')->name('store');
        Route::get('/{reservation}', 'show')->name('show');
        Route::put('/{reservation}', 'update')->name('update');
        Route::delete('/{reservation}', 'destroy')->name('destroy');
    });

Route::view('/confirmation', 'customer.reservations.confirmation')->name('confirmation');
