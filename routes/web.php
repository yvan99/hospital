<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Receptionist login routes
Route::prefix('receptionist')->group(function () {
    Route::get('/login', [ReceptionistLoginController::class, 'showLoginForm'])->name('receptionist.login');
    Route::post('/login', [ReceptionistLoginController::class, 'login'])->name('receptionist.login.submit');
    // Add other routes specific to the receptionist
});

// Doctor login routes
Route::prefix('doctor')->group(function () {
    Route::get('/login', [DoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('/login', [DoctorLoginController::class, 'login'])->name('doctor.login.submit');
    // Add other routes specific to the doctor
});

// Nurse login routes
Route::prefix('nurse')->group(function () {
    Route::get('/login', [NurseLoginController::class, 'showLoginForm'])->name('nurse.login');
    Route::post('/login', [NurseLoginController::class, 'login'])->name('nurse.login.submit');
    // Add other routes specific to the nurse
});
