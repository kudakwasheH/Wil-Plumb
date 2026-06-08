<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/portfolio', [PublicController::class, 'projects'])->name('projects');
Route::get('/testimonials', [PublicController::class, 'testimonials'])->name('testimonials');
Route::post('/testimonials', [PublicController::class, 'storeTestimonial'])->name('testimonials.store');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'storeContact'])->name('contact.store');
Route::get('/booking', [PublicController::class, 'booking'])->name('booking');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');
Route::get('/booking/success', [PublicController::class, 'bookingSuccess'])->name('booking.success');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Dashboard (Auth Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Index
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Services CRUD
    Route::resource('services', ServiceController::class)->except(['show']);

    // Projects CRUD
    Route::resource('projects', ProjectController::class)->except(['show']);

    // Service Requests (Bookings) Management
    Route::resource('requests', ServiceRequestController::class)->only(['index', 'show', 'update', 'destroy']);

    // Testimonials Management
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'toggleApproval'])->name('testimonials.approve');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Contact Messages Management
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    // Settings Management
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});
