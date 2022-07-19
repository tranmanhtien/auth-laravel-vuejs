<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
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
    Route::post('/login', [AuthController::class,'postLogin'])->name('login');
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'postRegister'])->name('register');
});

Route::name('password.')->prefix('password')->group(function () {
    Route::get('/forget-password', [PasswordController::class, 'forgetPassword'])->name('forget_password');
    Route::post('/reset-password', [PasswordController::class, 'resetPassword'])->name('reset_password');
    Route::get('/reset-password', [PasswordController::class, 'getResetPassword'])->name('reset_password');
    Route::post('/change-password', [PasswordController::class, 'postResetPassword'])->name('change_password');
});

//Admin
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view-order',[DashboardController::class,'order'])->name('order');
Route::get('/create-order',[DashboardController::class,'create'])->name('order.create');
Route::get('/edit-order/{id}',[DashboardController::class,'edit'])->name('order.edit');

