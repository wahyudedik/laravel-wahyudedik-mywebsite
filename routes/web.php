<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Products page
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// Collaboration page
Route::get('/collaboration', function () {
    return view('collaboration');
})->name('collaboration');

// Resume page
Route::get('/resume', [App\Http\Controllers\ResumeController::class, 'index'])->name('resume');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Unsubscribe route
Route::get('/unsubscribe', function () {
    return view('unsubscribe');
});
Route::post('/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resume management
    Route::resource('resume', App\Http\Controllers\Admin\ResumeController::class);
    // Nested routes for resume sections
    Route::prefix('resume/{resume}')->name('resume.')->group(function () {
        Route::resource('experience', App\Http\Controllers\Admin\WorkExperienceController::class)
            ->except(['show']);
        Route::resource('education', App\Http\Controllers\Admin\EducationController::class)
            ->except(['show']);
        Route::resource('project', App\Http\Controllers\Admin\ProjectController::class)
            ->except(['show']);
    });

    // Mark all notifications as read
    Route::post('/notifications/mark-all-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notifications.mark-all-read');

    // Contact management
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'adminShow'])->name('contacts.show');
    Route::delete('/contacts/{id}', [ContactController::class, 'adminDestroy'])->name('contacts.destroy');
    Route::post('/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contacts.reply');

    // Newsletter management
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');
    Route::patch('/newsletter/{id}/toggle', [NewsletterController::class, 'toggleStatus'])->name('newsletter.toggle');
    Route::get('/newsletter/send', [NewsletterController::class, 'showSendForm'])->name('newsletter.send.form');
    Route::post('/newsletter/send', [NewsletterController::class, 'send'])->name('newsletter.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
