<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SuperAdminController;

Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'updateProfileSuperAdmin'])->name('profile.update');
Route::post('profile/update/password',[ProfileController::class, 'updatePasswordSuperAdmin'])->name('password.update');