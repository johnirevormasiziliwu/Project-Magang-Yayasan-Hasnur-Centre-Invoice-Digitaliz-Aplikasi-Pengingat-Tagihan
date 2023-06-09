<?php

use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\EmailController as AdminEmailController;
use App\Http\Controllers\Admin\InvoiceItemController as AdminInvoiceItemController;
use App\Http\Controllers\Admin\SearchInvoiceController as AdminSearchInvoiceController;
use App\Http\Controllers\Admin\SearchEmailController as AdminSearchEmailController;
use App\Http\Controllers\Admin\CetakController as AdminCetakController;
use App\Http\Controllers\User\CetakController as UserCetakController;
use App\Http\Controllers\User\SearchController as UserSearchController;
use App\Http\Controllers\User\InvoiceController as UserInvoiceController;
use App\Helper\Controllers\DownloadInvoiceController;
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



//Route download invoiceemail
Route::get('/download/{invoice}', [DownloadInvoiceController::class, 'downloadInvoice'])->name('download.invoice');





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


    // Route getCustomer
    Route::post('/get-customer', [AdminInvoiceController::class, 'getCustomer'])->name('getCustomer');

    //Route admin user
    Route::resource('/customer', AdminCustomerController::class);

        //Route admin Send Email

    //Route admin Email
    Route::get('/email', [AdminEmailController::class, 'index'])->name('email.index');


    //Route admin Show Detail Email
    Route::get('/email/{invoice}', [AdminEmailController::class, 'viewEmail'])->name('viewEmail');


    //Route admin Send Email
    Route::get('/send-email/{invoice}', [AdminEmailController::class, 'sendEmail'])->name('sendemail');

    //Route admin kirim email
    Route::get('/markInvoiceAsPaid/{invoice}', [AdminEmailController::class, 'markInvoiceAsPaid'])->name('markInvoiceAsPaid');



    //Show_payment_receipt
    Route::get('/showpaymentreceipt/{invoice}', [AdminInvoiceController::class, 'show_payment_receipt'])->name('show_payment_receipt');

    //Route Confirm and Delete
    Route::post('/confirm-paymentreceipt', [AdminInvoiceController::class, 'deleteConfirm'])->name('invoice.deleteConfirm');

    //Confirm_payment_receipt
    Route::post('/confirm_payment/{invoice}', [AdminInvoiceController::class, 'confirm_payment'])->name('confirm_payment');

    // Download payment-receipt
    Route::get('/download/{invoice}/payment-receipt', [AdminInvoiceController::class, 'downloadPaymentReceipt'])->name('download-payment-receipt');

    // Download Invoice
    Route::get('/download/{invoice}/invoice', [AdminCetakController::class, 'downloadInvoice'])->name('download-invoice');

    // Print invoice 
    Route::get('/print/{invoice}/invoice', [AdminCetakController::class, 'printInvoice'])->name('print-invoice');

    // Print all invoice
    Route::get('/print-all-invoice', [AdminCetakController::class, 'printAll'])->name('print-invoice-all');

    // search invoice
    Route::get('/search/invoice', [AdminSearchInvoiceController::class, 'searchInvoice'])->name('invoice.search');

    //Search email 
    Route::get('/search/email', [AdminSearchEmailController::class, 'searchEmail'])->name('email.search');
});


//Route untuk user

Route::prefix('user')->middleware(['role:user'])->name('user.')->group(function () {
    Route::resource('invoice', UserInvoiceController::class);

    // Route  form payment receipt invoice
    Route::get('invoice/paymentreceipt/{invoice}', [UserInvoiceController::class, 'formPaymentReceipt'])->name('payment-receipt');

    // Route upload payment receipt invoice
    Route::post('invoice/upload/paymentreceipt/{invoice}', [UserInvoiceController::class, 'uploadPaymentReceipt'])->name('upload-payment-receipt');

    // search invoice
    Route::get('/search', [UserSearchController::class, 'search'])->name('search');

    // Download Invoice
    Route::get('/download/{invoice}/invoice', [UserCetakController::class, 'downloadInvoice'])->name('download-invoice');

    // Print invoice 
    Route::get('/print/{invoice}/invoice', [UserCetakController::class, 'printInvoice'])->name('print-invoice');
});


require __DIR__ . '/auth.php';
