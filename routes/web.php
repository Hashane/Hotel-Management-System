<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/rooms', function () {
    return view('rooms');
})->name('rooms');

Route::get('/room-details', function () {
    return view('room-details');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
