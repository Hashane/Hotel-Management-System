<?php

use App\Http\Controllers\admin\AdminCartController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ReservationController as AdminReservationController;
use Illuminate\Support\Facades\Route;

Route::get('admin/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

    Route::controller(AdminReservationController::class)->prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/{reservation}/check-in', 'checkIn')->name('check-in');
        Route::post('/{reservation}/check-out', 'checkOut')->name('check-out');
        Route::post('/{reservation}/add-charges', 'addCharges')->name('add-charges');
        Route::put('/{reservation}', 'update')->name('update');
        Route::delete('/{reservation}', 'destroy')->name('destroy');
    });

    Route::controller(CustomerController::class)->name('customers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{customer}', 'update')->name('update');
    });

    Route::controller(AdminCartController::class)->prefix('carts')->name('carts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/book', 'book')->name('book');
        Route::post('/assign', 'assign')->name('assign');
        Route::patch('/{cart}', 'update')->name('update');
        Route::delete('/{cart}', 'destroy')->name('destroy');
    });

    Route::view('/reports', 'admin.report');

});
