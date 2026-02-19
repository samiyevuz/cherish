<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('kirish', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('kirish', [AuthenticatedSessionController::class, 'store']);

    Route::get('royxatdan-otish', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('royxatdan-otish', [RegisteredUserController::class, 'store']);

    Route::get('parolni-tiklash', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('parolni-tiklash', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('parolni-tiklash/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('parolni-yangilash', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('chiqish', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
