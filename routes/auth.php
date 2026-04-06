<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ConfirmablePasswordController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [EmailVerificationNotificationController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['throttle:6,1'])
                ->name('verification.send');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('confirm-password', [ConfirmablePasswordController::class, 'update'])
                ->name('password.confirm');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
