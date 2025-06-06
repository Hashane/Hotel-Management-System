<?php

use App\Http\Controllers\admin\ProfileController;
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


Route::view('/reservations','admin.reservations.index')->name('reservations.index');
Route::view('/reservations/create','admin.reservations.create')->name('reservations.create');

});

require __DIR__.'/auth.php';

Route::controller(RoomController::class)->group(function (){
    Route::get('/rooms', 'index')->name('rooms');
});

Route::view('/', 'customer.index')->name('home');
Route::view('/about', 'customer.about')->name('about');
Route::view('/cart', 'customer.cart')->name('cart');

Route::view('/room-details', 'customer.room-details')->name('room.details');
Route::view('/contact', 'customer.contact')->name('contact');
