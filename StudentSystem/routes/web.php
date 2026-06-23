<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPortalController;
use App\Http\Controllers\FeeController;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student portal (logged-in students only)
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [StudentPortalController::class, 'profile'])->name('student.profile');
    Route::post('/my-profile', [StudentPortalController::class, 'updateProfile'])->name('student.profile.update');
    Route::post('/my-profile/password', [StudentPortalController::class, 'updatePassword'])->name('student.password.update');
    Route::get('/my-info', [StudentPortalController::class, 'info'])->name('student.info');
    Route::get('/my-fees', [StudentPortalController::class, 'fees'])->name('student.fees');
});

// Admin panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\AdminProfileController::class, 'update'])->name('profile.update');
    Route::resource('students', StudentController::class);
    Route::resource('fees', FeeController::class);
    Route::get('fees/{fee}/bill', [FeeController::class, 'bill'])->name('fees.bill');
});
