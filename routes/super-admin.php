<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileSuperAdminController;
use App\Http\Controllers\Backend\SuperAdminController;

Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileSuperAdminController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileSuperAdminController::class,'updateProfileSuperAdmin'])->name('profile.update');
Route::post('profile/update/password',[ProfileSuperAdminController::class,'updatePasswordSuperAdmin'])->name('password.update');