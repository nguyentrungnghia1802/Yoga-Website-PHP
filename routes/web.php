<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminController;

// Public routes for users (no authentication required)
Route::get('/', [WebController::class, 'dashboard'])->name('dashboard');
Route::get('/classes', [WebController::class, 'classes'])->name('classes');
Route::get('/classes/{id}', [WebController::class, 'classDetail'])->name('class.detail');
Route::get('/teachers', [WebController::class, 'teachers'])->name('teachers');
Route::get('/teachers/{id}', [WebController::class, 'teacherDetail'])->name('teacher.detail');
Route::get('/register', [WebController::class, 'register'])->name('register');
Route::post('/register', [WebController::class, 'registerSubmit'])->name('register.submit');
Route::get('/authors', [WebController::class, 'authors'])->name('authors');
Route::get('/registered-classes', [WebController::class, 'registeredClasses'])->name('registered.classes');
Route::get('/registered-classes/{id}', [WebController::class, 'registeredClassDetail'])->name('registered.class.detail');

// Admin routes with authentication
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes (no auth required)
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    
    // Redirect /admin to login if not authenticated
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    
    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
        // Registration management
    Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
    Route::get('/registrations/create', [AdminController::class, 'showCreateRegistration'])->name('registrations.create');
    Route::post('/registrations/create', [AdminController::class, 'createRegistration']);
        Route::get('/registrations/{id}/edit', [AdminController::class, 'showEditRegistration'])->name('registrations.edit');
        Route::put('/registrations/{id}', [AdminController::class, 'updateRegistration'])->name('registrations.update');
        Route::delete('/registrations/{id}', [AdminController::class, 'destroyRegistration'])->name('registrations.destroy');
        Route::get('/registrations/{id}', [AdminController::class, 'registrationDetail'])->name('registrations.detail');
        Route::post('/registrations/{id}/approve', [AdminController::class, 'approveRegistration'])->name('registrations.approve');
        Route::post('/registrations/{id}/reject', [AdminController::class, 'rejectRegistration'])->name('registrations.reject');
        
        // Class management
        Route::get('/classes', [AdminController::class, 'classes'])->name('classes');
        Route::get('/classes/create', [AdminController::class, 'createClass'])->name('classes.create');
        Route::post('/classes', [AdminController::class, 'storeClass'])->name('classes.store');
        Route::get('/classes/{id}', [AdminController::class, 'classDetail'])->name('classes.detail');
        Route::get('/classes/{id}/edit', [AdminController::class, 'editClass'])->name('classes.edit');
        Route::put('/classes/{id}', [AdminController::class, 'updateClass'])->name('classes.update');
        Route::delete('/classes/{id}', [AdminController::class, 'deleteClass'])->name('classes.delete');
        
        // Customer management
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customers/create', [AdminController::class, 'createCustomer'])->name('customers.create');
        Route::post('/customers', [AdminController::class, 'storeCustomer'])->name('customers.store');
        Route::post('/customers/search', [AdminController::class, 'searchCustomer'])->name('customers.search');
        Route::get('/customers/{id}', [AdminController::class, 'customerDetail'])->name('customers.detail');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('customers.delete');
        
        // Teacher management
        Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers');
        Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
        Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
        Route::get('/teachers/{id}', [AdminController::class, 'teacherDetail'])->name('teachers.detail');
        Route::get('/teachers/{id}/edit', [AdminController::class, 'editTeacher'])->name('teachers.edit');
        Route::put('/teachers/{id}', [AdminController::class, 'updateTeacher'])->name('teachers.update');
        Route::delete('/teachers/{id}', [AdminController::class, 'deleteTeacher'])->name('teachers.delete');
    });
});
