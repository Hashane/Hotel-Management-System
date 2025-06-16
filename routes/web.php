<?php

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';

Route::get('/session-test', function () {
    session(['test' => now()]);

    return response()->json([
        'id' => session()->getId(),
        'test_value' => session('test'),
        'cart' => session('cart', []),
    ]);
});
