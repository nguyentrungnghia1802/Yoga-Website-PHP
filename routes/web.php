<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

// Public routes
Route::get('/', [WebController::class, 'dashboard'])->name('dashboard');
Route::get('/authors', [WebController::class, 'authors'])->name('authors');
Route::get('/classes', [WebController::class, 'classes'])->name('classes');

// Auth routes
Route::get('/login', [WebController::class, 'loginAccount'])->name('login');
Route::post('/login', [WebController::class, 'loginAccountSubmit'])->name('login.submit');
Route::get('/register-account', [WebController::class, 'registerAccount'])->name('register.account');
Route::post('/register-account', [WebController::class, 'registerAccountSubmit'])->name('register.account.submit');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/registered-classes', [WebController::class, 'registeredClasses'])->name('registered.classes');
    Route::get('/registered-classes/{id}', [WebController::class, 'registeredClassDetail'])->name('registered.class.detail');
    Route::get('/register', [WebController::class, 'register'])->name('register');
    Route::post('/register', [WebController::class, 'registerSubmit'])->name('register.submit');
    Route::get('/contact', [WebController::class, 'contact'])->name('contact');
    Route::post('/contact', [WebController::class, 'contactSend'])->name('contact.send');
    Route::get('/account', [WebController::class, 'account'])->name('account');
    Route::get('/profile', [WebController::class, 'profile'])->name('profile');
    Route::post('/logout', [WebController::class, 'logout'])->name('logout');
});

// Admin routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [WebController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/classes', [WebController::class, 'adminClasses'])->name('classes');
    Route::get('/teachers', [WebController::class, 'adminTeachers'])->name('teachers');
    Route::get('/registrations', [WebController::class, 'adminRegistrations'])->name('registrations');
});
