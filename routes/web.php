<?php

use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\EmailController as AdminEmailController;
use App\Http\Controllers\User\InvoiceController as UserInvoiceController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route Logout
Route::post('/logout', [AuthLogoutController::class, 'logout'])->name('logout');

//Route Middleware Admin

Route::middleware(['admin'])->group(function () {

    //Route Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        //Route admin inovice
        Route::resource('invoice', AdminInvoiceController::class);

        // Route getCustomer
        Route::post('get-customer', [AdminInvoiceController::class, 'getCustomer'])->name('getCustomer');

        //Route admin user
        Route::resource('customer', AdminCustomerController::class);

        //Route admin user delete and form edit
        Route::post('customer/edit', [AdminCustomerController::class, 'deleteEditCustomer'])->name('customer.deleteedit');

        //Route admin Email
        Route::get('email', [AdminEmailController::class, 'index'])->name('email.index');


        //Route admin SendEmail
        Route::get('send-email/{invoice}', [AdminEmailController::class, 'sendEmail'])->name('sendemail');

        //Show_payment_receipt
        Route::get('showpaymentreceipt/{invoice}', [AdminInvoiceController::class, 'show_payment_receipt'])->name('show_payment_receipt');

        //Route Confirm and Delete
        Route::post('confirm', [AdminInvoiceController::class, 'deleteConfirm'])->name('invoice.deleteConfirm');

        //Confirm_payment_receipt
        Route::post('confirm_payment/{invoice}', [AdminInvoiceController::class, 'confirm_payment'])->name('confirm_payment');
    });
});



Route::prefix('user')->name('user.')->group(
    function () {

        //Route user inovice
        Route::resource('invoice', UserInvoiceController::class);

        //form upload_payment_receipt
        Route::get('paymentreceipt/{invoice}', [UserInvoiceController::class, 'form_payment_receipt'])->name('payment_receipt');


        //Upload_payment_receipt
        Route::post('uploadpaymentreceipt/{invoice}', [UserInvoiceController::class, 'upload_payment_receipt'])->name('upload_payment_receipt');
    }
);

require __DIR__.'/auth.php';
