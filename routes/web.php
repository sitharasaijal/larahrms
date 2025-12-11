<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;


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




Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('/post-login', [AdminAuthController::class, 'postLogin']);
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/employees', [EmployeeController::class, 'employees'])->name('employees');
    Route::post('/employees_data', [EmployeeController::class, 'getEmployeesData'])->name('employees.data');
    Route::get('/departments', [DepartmentController::class, 'departments'])->name('departments');
    Route::post('/post-department', [DepartmentController::class, 'postDepartment'])->name('post-department');
    Route::get('department/{id}', [DepartmentController::class, 'getDepartmentById'])->name('get-department-by-id');
    Route::get('/designations', [DesignationController::class, 'designations'])->name('designations');
    Route::post('/post-designation', [DesignationController::class, 'postDesignation'])->name('post-designation');
    Route::get('designation/{id}', [DesignationController::class, 'getDesignationById'])->name('get-designation-by-id');

});









