<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

// Public web routes
Route::get('/', [WebController::class, 'dashboard'])->name('dashboard');
Route::get('/classes', [WebController::class, 'classes'])->name('classes');
Route::get('/team', [WebController::class, 'team'])->name('team');
Route::get('/members', [WebController::class, 'members'])->name('members');
Route::get('/register', [WebController::class, 'register'])->name('register');
Route::post('/register', [WebController::class, 'registerSubmit'])->name('register.submit');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/authors', [WebController::class, 'authors'])->name('authors');
Route::get('/login', [WebController::class, 'login'])->name('login');
Route::post('/login', [WebController::class, 'loginSubmit'])->name('login.submit');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [WebController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/classes', [WebController::class, 'adminClasses'])->name('classes');
    Route::get('/teachers', [WebController::class, 'adminTeachers'])->name('teachers');
    Route::get('/registrations', [WebController::class, 'adminRegistrations'])->name('registrations');
});
