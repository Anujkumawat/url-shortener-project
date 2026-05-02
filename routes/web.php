<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.exportPdf');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invite
    Route::post('/invite-admin', [InviteController::class, 'inviteAdmin'])
        ->name('invite.admin');
    Route::post('/invite-member', [InviteController::class, 'inviteMember'])
        ->name('invite.member');
    Route::post('/shorten', [UrlController::class, 'store'])->name('url.store');
    Route::get('/urls', [UrlController::class, 'index'])->name('urls.index');
    Route::get('/download-urls', [UrlController::class, 'download'])->name('urls.download');
});

require __DIR__ . '/auth.php';

// Protected redirect (PDF compliant)
Route::get('/u/{code}', function ($code) {
    $url = \App\Models\Url::where('short_code', $code)->firstOrFail();

    $url->increment('clicks');

    return redirect($url->original_url);
});

// disable register
Route::get('/register', fn() => abort(404));
