<?php

use App\Http\Controllers\admin\ProfileController;
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
});

require __DIR__.'/auth.php';

Route::view('/', 'customer.index')->name('home');
Route::view('/about', 'customer.about')->name('about');
Route::view('/rooms', 'customer.rooms')->name('rooms');
Route::view('/room-details', 'customer.room-details')->name('room.details');
Route::view('/contact', 'customer.contact')->name('contact');
