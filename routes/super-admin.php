<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LayananController;
use App\Http\Controllers\Backend\PerusahaanController;
use App\Http\Controllers\Backend\SuperAdminController;
use App\Http\Controllers\Backend\ProfileSuperAdminController;
use App\Http\Controllers\Backend\SuperAdminLayananController;
use App\Http\Controllers\Backend\SuperAdminPerusahaanController;

Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileSuperAdminController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileSuperAdminController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileSuperAdminController::class, 'updatePassword'])->name('password.update');

//--------- PERUSAHAAN ROUTES -------------//
Route::resource('perusahaan', SuperAdminPerusahaanController::class);

//------------ LAYANAN ROUTES ----------//
Route::resource('layanan', SuperAdminLayananController::class);