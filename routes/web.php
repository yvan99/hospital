<?php

use App\Http\Controllers\AuthDoctorLoginController;
use App\Http\Controllers\AuthNurseLoginController;
use App\Http\Controllers\AuthReceptionistLoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientOrderController;
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
        Route::resource('patients', PatientController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('nurses', NurseController::class);
        Route::resource('patients', PatientController::class);
        Route::post('/patient_orders', [PatientOrderController::class, 'store'])->name('patient_orders.store');

    });
});

Route::middleware('auth:doctor')->group(function () {
    Route::prefix('doctor')->group(function () {
        Route::view('/dashboard', 'doctor.dashboard');
        Route::get('/doctor/patient-orders', [DoctorController::class, 'patientOrders'])->name('doctors.patientOrders');
        Route::post('/doctor/patient-orders/{orderId}/assign', [DoctorController::class, 'assignPatientOrder'])->name('doctors.assignPatientOrder');
    });
});

Route::middleware('auth:nurse')->group(function () {
    Route::prefix('nurse')->group(function () {
        // Add nurse dashboard routes here
    });
});
