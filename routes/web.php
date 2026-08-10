<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ChatController;
use App\Http\Controllers\Public\CollectionController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\FaqController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/bahasa/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/koleksi', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/koleksi/{collection:slug}', [CollectionController::class, 'show'])->name('collections.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/agenda/by-date', [\App\Http\Controllers\Public\AgendaController::class, 'byDate'])->name('agenda.by-date');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::post('/feedback', [\App\Http\Controllers\Public\FeedbackController::class, 'store'])->name('feedback.store');

Route::prefix('chat')->name('chat.')->group(function (): void {
    Route::post('/sessions', [ChatController::class, 'startSession'])->name('start');
    Route::get('/sessions/{session:uuid}/messages', [ChatController::class, 'messages'])->name('messages');
    Route::post('/sessions/{session:uuid}/messages', [ChatController::class, 'sendMessage'])->name('send');
});

require __DIR__.'/admin.php';