<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---admin---//

//dashboard
Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

//invoice
Route::get('/admin/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice');
Route::get('/admin/add-invoice', [App\Http\Controllers\InvoiceController::class, 'add'])->name('add-invoice');

Route::get('/admin/email', [App\Http\Controllers\EmailController::class, 'index'])->name('email');

//user
Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/admin/add-user', [App\Http\Controllers\UserController::class, 'add'])->name('add-user');
