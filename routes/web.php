<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard')->middleware('auth');

Route::resource('department', DepartmentController::class);
Route::resource('employee', EmployeeController::class);
Route::get('/employee/department/{id}', [EmployeeController::class, 'getDeptEmployees']);
Route::get('/employee/department/{id}/json', [EmployeeController::class, 'getDeptEmployeesJson']);
