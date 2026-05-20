<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/booking', [BookingController::class, 'choose'])->name('booking.choose');