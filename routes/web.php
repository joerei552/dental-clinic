<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/schedule', function () {
    return view('schedule');
})->name('schedule');
Route::resource('appointments', AppointmentController::class);
