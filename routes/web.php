<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsletterController;

Route::get('/', function () {
    return view('welcome');
});

// Public feedback routes
Route::get('feedback/{token}', [FeedbackController::class, 'edit'])
    ->name('feedback.edit')
    ->middleware('signed');
Route::post('feedback/{token}', [FeedbackController::class, 'update'])
    ->name('feedback.update');
Route::get('feedback-thank-you', [FeedbackController::class, 'thankYou'])
    ->name('feedback.thank-you');

// Products page
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Product download route (protected by token)
Route::get('/products/download/{order}/{token}', [App\Http\Controllers\ProductController::class, 'download'])->name('products.download');

// Order routes
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{orderNumber}/payment', [OrderController::class, 'payment'])->name('orders.payment');
Route::post('/orders/{orderNumber}/upload-proof', [OrderController::class, 'uploadProof'])->name('orders.upload-proof');
Route::get('/orders/{orderNumber}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');
Route::get('/orders/{orderNumber}/status', [OrderController::class, 'status'])->name('orders.status');

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

    // Feedback
    Route::resource('feedback', App\Http\Controllers\Admin\FeedbackController::class);

    // Products management
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    // Orders management
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->except(['create', 'store', 'destroy']);

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

// Review routes
Route::post('/products/{product}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('products.review');

require __DIR__ . '/auth.php';
