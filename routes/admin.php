<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
<<<<<<< HEAD

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');
=======
//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');
>>>>>>> 9be36c4706f2310512ce34069778e4bf6195eb47
