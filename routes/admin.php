<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\EnsureActiveUser;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware(['auth', EnsureActiveUser::class])->group(function (): void {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        Route::middleware('permission:dashboard.view')->group(function (): void {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        });

        Route::middleware('permission:news.manage')->group(function (): void {
            Route::resource('news', NewsController::class)->except(['show']);
        });

        Route::middleware('permission:collections.manage')->group(function (): void {
            Route::resource('collections', CollectionController::class)->except(['show']);
        });

        Route::middleware('permission:agendas.manage')->group(function (): void {
            Route::resource('agendas', AgendaController::class)->except(['show']);
        });

        Route::middleware('permission:hero-slides.manage')->group(function (): void {
            Route::patch('/hero-slides/{heroSlide}/toggle-active', [HeroSlideController::class, 'toggleActive'])
                ->name('hero-slides.toggle-active');

            Route::post('/hero-slides/activate-top', [HeroSlideController::class, 'activateTop'])
                ->name('hero-slides.activate-top');

            Route::post('/hero-slides/deactivate-all', [HeroSlideController::class, 'deactivateAll'])
                ->name('hero-slides.deactivate-all');

            Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
        });

        Route::middleware('permission:feedback.view')->group(function (): void {
            Route::get('/feedback', [FeedbackController::class, 'index'])
                ->name('feedback.index');
        });

        Route::middleware('permission:contact-messages.manage')->group(function (): void {
            Route::get('/contact-messages', [ContactMessageController::class, 'index'])
                ->name('contact-messages.index');

            Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
                ->name('contact-messages.show');

            Route::post('/contact-messages/{contactMessage}/reply', [ContactMessageController::class, 'reply'])
                ->name('contact-messages.reply');

            Route::patch('/contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])
                ->name('contact-messages.status.update');

            Route::patch('/contact-messages/{contactMessage}/unread', [ContactMessageController::class, 'unread'])
                ->name('contact-messages.unread');
        });

        Route::middleware('permission:users.manage')->group(function (): void {
            Route::patch('/users/{user}/password', [UserController::class, 'updatePassword'])
                ->name('users.password.update');

            Route::resource('users', UserController::class)->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
            ]);
        });

        Route::middleware('permission:activity-log.view')->group(function (): void {
            Route::get('/activity-logs', [ActivityLogController::class, 'index'])
                ->name('activity-logs.index');
        });
    });
});