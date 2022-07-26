<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
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
Route::name('auth.')->group( function () {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'postLogin']);
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'postRegister']);
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::name('password.')->prefix('password')->group(function () {
    Route::get('/forget-password', [PasswordController::class, 'forgetPassword'])->name('forget_password');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
    Route::get('/reset-password', [PasswordController::class, 'getResetPassword'])->name('reset_password');
    Route::post('/change-password', [PasswordController::class, 'postResetPassword'])->name('change_password');
});

//Admin
Route::middleware('member')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    //role
    Route::resources(['role' => RoleController::class]);
    Route::get('/role/{search}')->name('roleSearch');
    Route::post('/role/{role}',[RoleController::class, 'updateRole'])->name('updateRole');

    //permission
    Route::get('/permission',[PermissionController::class, 'index'])->name('permission');
});



