<?php

use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\EmailController as AdminEmailController;
use App\Http\Controllers\Admin\InvoiceItemController as AdminInvoiceItemController;
use App\Http\Controllers\User\InvoiceController as UserInvoiceController;
use App\Http\Controllers\ProfileController;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

//Route Logout
Route::post('/logout', [AuthLogoutController::class, 'logout'])->name('logout');



//Route Middleware Admin





    //Route Admin
    Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        //Route admin inovice
        Route::resource('/invoice', AdminInvoiceController::class);
      

        //Route admin show invoice items
        Route::get('invoices/{invoice}/invoiceitem/{invoiceItem}', [AdminInvoiceItemController::class, 'show'])->name('invoiceitems.show');


        // Route admin edit invoice items
        Route::get('/invoices/{invoice}/invoiceitems/{invoiceitem}/edit', [AdminInvoiceItemController::class, 'edit'])->name('invoiceitems.edit');

        // Route admin update invoice items
        Route::put('/invoices/{invoice}/invoiceitems/{invoiceitem}/update', [AdminInvoiceItemController::class, 'update'])->name('invoiceitems.update');

        // Route admin delete invoice items
        Route::delete('/invoices/{invoice}/invoiceitems/{invoiceitem}/destroy', [AdminInvoiceItemController::class, 'destroy'])->name('invoiceitems.destroy');

        
        // Route getCustomer
        Route::post('/get-customer', [AdminInvoiceController::class, 'getCustomer'])->name('getCustomer');

        //Route admin user
        Route::resource('/customer', AdminCustomerController::class);

        //Route admin delete customer 
        Route::post('/customer/delete', [AdminCustomerController::class, 'delete'])->name('customer.delete');
        Route::post('/customer/multi-delete', [AdminCustomerController::class, 'multiDelete'])->name('multi-delete');


        //Route admin Email
        Route::get('/email', [AdminEmailController::class, 'index'])->name('email.index');
        
        

        //Route admin Show Detail Email
        Route::get('/email/{invoice}', [AdminEmailController::class, 'viewEmail'])->name('viewEmail');
        

        //Route admin Send Email
        Route::get('/send-email/{invoice}', [AdminEmailController::class, 'sendEmail'])->name('sendemail');
        Route::get('/go-email/{invoice}', [AdminEmailController::class, 'goEmail'])->name('goEmail');


        //Show_payment_receipt
        Route::get('/showpaymentreceipt/{invoice}', [AdminInvoiceController::class, 'show_payment_receipt'])->name('show_payment_receipt');

        //Route Confirm and Delete
        Route::post('/confirm-paymentreceipt', [AdminInvoiceController::class, 'deleteConfirm'])->name('invoice.deleteConfirm');

        //Confirm_payment_receipt
        Route::post('/confirm_payment/{invoice}', [AdminInvoiceController::class, 'confirm_payment'])->name('confirm_payment');

        // Download payment-receipt
        Route::get('/download/{invoice}/payment-receipt', [AdminInvoiceController::class, 'downloadPaymentReceipt'])->name('download-payment-receipt');

        // Download Invoice
        Route::get('/download/{invoice}/invoice', [AdminInvoiceController::class, 'downloadInvoice'])->name('download-invoice');

        // Print invoice 
        Route::get('generate-pdf/{invoice}/invoice', [AdminInvoiceController::class, 'generatePdfInvoice'])->name('generate-pdf-invoice');
    });


//Route untuk user

    Route::prefix('user')->middleware(['role:user'])->name('user.')->group(function () {
        Route::resource('invoice', UserInvoiceController::class);

        // Route  form payment receipt invoice
        Route::get('invoice/paymentreceipt/{invoice}', [UserInvoiceController::class, 'formPaymentReceipt'])->name('payment-receipt');

        // Route upload payment receipt invoice
        Route::post('invoice/upload/paymentreceipt/{invoice}', [UserInvoiceController::class, 'uploadPaymentReceipt'])->name('upload-payment-receipt');

        // Download Invoice
        Route::get('/download/{invoice}/generate', [AdminInvoiceController::class, 'downloadInvoice'])->name('download-invoice');

    });


require __DIR__ . '/auth.php';
