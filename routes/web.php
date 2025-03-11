<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Front\LandingController;

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('item', AdminItemController::class);
    Route::resource('brand', AdminBrandController::class);
    Route::resource('type', AdminTypeController::class);
    Route::resource('booking', AdminBookingController::class);
    Route::resource('faq', AdminFaqController::class);
});
