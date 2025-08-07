<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;



// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('departments', DepartmentController::class);

// Employee routes
Route::get('/', [EmployeeController::class, 'deshbord'])->name('deshbord');
Route::get('/index', [EmployeeController::class, 'index'])->name('index');
Route::get('/create', [EmployeeController::class, 'create'])->name('create');
Route::post('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
Route::delete('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('delete');


Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');
Route::post('/profile',[EmployeeController::class, 'profile_update'])->name('profile-update');