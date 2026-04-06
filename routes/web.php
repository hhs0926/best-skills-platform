<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

// 静态页面
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/guide', [PageController::class, 'guide'])->name('guide');

// 社区 & 交换
Route::view('/community', 'community')->name('community');
Route::view('/exchange', 'exchange')->name('exchange');

// Dashboard - 需要登录
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('skills')->group(function () {
    Route::get('/', [SkillController::class, 'index'])->name('skills.index');
    Route::get('/{skill}', [SkillController::class, 'show'])->name('skills.show');
});

require __DIR__.'/auth.php';
