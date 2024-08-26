<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\LayananController;
use App\Http\Controllers\Backend\PerusahaanController;
use App\Http\Controllers\Backend\PICController;
use App\Http\Controllers\Backend\ProfileController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');

//--------- PERUSAHAAN ROUTES -------------//
Route::resource('perusahaan', PerusahaanController::class);

//------------ LAYANAN ROUTES ----------//
Route::resource('layanan', LayananController::class);