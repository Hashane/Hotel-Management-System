<?php

use App\Http\Controllers\Admin\AdminCartController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomReservationController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AdditionalFacilitiesController;
use App\Http\Controllers\Admin\UserController;
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

    Route::controller(ReservationController::class)->prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::put('/{reservation}', 'update')->name('update');
        Route::delete('/{reservation}', 'destroy')->name('destroy');
    });

    Route::controller(RoomReservationController::class)->prefix('roomReservations')->name('roomReservations.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{roomReservation}/check-in', 'checkIn')->name('check-in');
        Route::post('/{roomReservation}/check-out', 'checkOut')->name('check-out');
        Route::post('/{roomReservation}/add-charges', 'addCharges')->name('add-charges');
    });

    Route::controller(RoomController::class)->prefix('rooms')->name('rooms.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        // Route::get('/services', 'services')->name('services');
        Route::get('/facilities', 'facilities')->name('facilities');
        Route::get('/extra_facilities', 'extra_facilities')->name('extra_facilities');

    });

    Route::controller(ServiceController::class)->prefix('services')->name('services.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');

    });

    Route::controller(AdditionalFacilitiesController::class)->prefix('additionalFacilities')->name('additionalFacilities.')->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/create', 'create')->name('create');

    });

    Route::controller(SeasonController::class)->prefix('seasons')->name('seasons.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{season}', 'destroy')->name('destroy');
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

    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/{user}', 'update')->name('update');
        Route::put('/{user}/assign-role', 'assignRole')->name('assign-role');
    });

    Route::controller(RoleController::class)->middleware(['permission:create_users'])->prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/{role}/permissions', 'updatePermissions')->name('update-permissions');
    });

    Route::controller(BillController::class)->prefix('billings')->name('billings.')->group(function () {
        Route::get('/{bill}', 'show')->name('show');
        Route::post('/{bill}', 'pay')->name('pay');
    });

    Route::get('/reports', [ReportsController::class, 'dailyReport'])->name('reports.daily');
    Route::get('/reports/export', [ReportsController::class, 'export'])->name('reports.export');
});
