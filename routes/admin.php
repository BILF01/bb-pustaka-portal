<?php

use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceRequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware(['auth', 'role:admin'])->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('news', NewsController::class)->except(['show']);
        Route::resource('collections', CollectionController::class)->except(['show']);
        Route::resource('agendas', AgendaController::class)->except(['show']);

        Route::get('/feedback', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
    });
});