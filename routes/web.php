<?php

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';

Route::get('/set-session', function () {
    session(['test' => '123']);

    return 'Session set!';
});

Route::get('/get-session', function () {
    return session('test') ?? 'No session value';
});

Route::get('/session-debug', function () {
    return [
        'id' => session()->getId(),
        'all' => session()->all(),
        'config' => config('session'),
    ];
});
