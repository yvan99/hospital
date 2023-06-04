<?php

use App\Http\Controllers\AuthDoctorLoginController;
use App\Http\Controllers\AuthNurseLoginController;
use App\Http\Controllers\AuthReceptionistLoginController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Receptionist Auth
Route::prefix('receptionist')->group(function () {
    Route::get('/login', [AuthReceptionistLoginController::class, 'showLoginForm'])->name('receptionist.login');
    Route::post('/login', [AuthReceptionistLoginController::class, 'login'])->name('receptionist.login.submit');
    Route::get('/logout', [AuthReceptionistLoginController::class, 'logout'])->name('receptionist.logout');
});

// Doctor Auth
Route::prefix('doctor')->group(function () {
    Route::get('/login', [AuthDoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('/login', [AuthDoctorLoginController::class, 'login'])->name('doctor.login.submit');
    Route::get('/logout', [AuthDoctorLoginController::class, 'logout'])->name('doctor.logout');
});

// Nurse Auth
Route::prefix('nurse')->group(function () {
    Route::get('/login', [AuthNurseLoginController::class, 'showLoginForm'])->name('nurse.login');
    Route::post('/login', [AuthNurseLoginController::class, 'login'])->name('nurse.login.submit');
    Route::get('/logout', [AuthNurseLoginController::class, 'logout'])->name('nurse.logout');
});

// AUTHENTICATED MIDDLEWARE ROUTES

Route::middleware('auth:receptionist')->group(function () {
    Route::prefix('receptionist')->group(function () {
        Route::view('/dashboard', 'receptionist.dashboard');
        Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    });
});

Route::middleware('auth:doctor')->group(function () {
    Route::prefix('doctor')->group(function () {
        // Add doctor dashboard routes here
    });
});

Route::middleware('auth:nurse')->group(function () {
    Route::prefix('nurse')->group(function () {
        // Add nurse dashboard routes here
    });
});
