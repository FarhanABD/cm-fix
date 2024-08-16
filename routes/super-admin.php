<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SuperAdminController;

Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');