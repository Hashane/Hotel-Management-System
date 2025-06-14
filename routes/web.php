<?php

use App\Http\Controllers\admin\AdminCartController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ReservationController as AdminReservationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('admin/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(RoomController::class)->name('profile.')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

    Route::controller(AdminReservationController::class)->prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::put('/{reservation}', 'update')->name('update');
        Route::delete('/{reservation}', 'destroy')->name('destroy');
    });

    Route::controller(CustomerController::class)->name('customers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{customer}', 'update')->name('update');
        Route::post('/check-in', 'checkIn')->name('check-in');
    });

    Route::controller(AdminCartController::class)->prefix('carts')->name('carts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/book', 'book')->name('book');
        Route::patch('/{cart}', 'update')->name('update');
        Route::delete('/{cart}', 'destroy')->name('destroy');
    });

    Route::view('/cart', 'admin.cart.index')->name('cart.index');
    //    Route::view('/reservations', 'admin.reservations.index')->name('reservations.index');

    Route::view('/reports', 'admin.report');

});

require __DIR__.'/auth.php';

Route::controller(RoomController::class)->group(function () {
    Route::get('/rooms', 'index')->name('rooms.index');
    Route::view('/rooms/{room}', 'customer.rooms.show')->name('rooms.show');
});

Route::view('/', 'customer.index')->name('home');
Route::view('/about', 'customer.about')->name('about');
// Route::view('/cart', 'customer.cart')->name('cart');

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
