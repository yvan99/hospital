<?php

use App\Http\Controllers\AuthDoctorLoginController;
use App\Http\Controllers\AuthNurseLoginController;
use App\Http\Controllers\AuthReceptionistLoginController;
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
    Route::get('/login', [AuthReceptionistLoginController::class, 'showLoginForm'])->name('receptionist.login');
    Route::post('/login', [AuthReceptionistLoginController::class, 'login'])->name('receptionist.login.submit');
    // Add other routes specific to the receptionist
});

// Doctor login routes
Route::prefix('doctor')->group(function () {
    Route::get('/login', [AuthDoctorLoginController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('/login', [AuthDoctorLoginController::class, 'login'])->name('doctor.login.submit');
    // Add other routes specific to the doctor
});

// Nurse login routes
Route::prefix('nurse')->group(function () {
    Route::get('/login', [AuthNurseLoginController::class, 'showLoginForm'])->name('nurse.login');
    Route::post('/login', [AuthNurseLoginController::class, 'login'])->name('nurse.login.submit');
    // Add other routes specific to the nurse
});

// AUTHENTICATED MIDDLEWARE ROUTES

Route::middleware('auth:receptionist')->group(function () {
    Route::prefix('receptionist')->group(function () {
        // Add receptionist dashboard routes here
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
