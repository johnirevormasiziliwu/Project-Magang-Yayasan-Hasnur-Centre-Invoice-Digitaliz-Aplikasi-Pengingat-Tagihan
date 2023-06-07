<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');
      
        // Ambil model pengguna yang sedang login
        $user = $request->user();
      
        // Ambil customer yang dimiliki oleh pengguna yang sedang login
        $customer = Customer::where('user_id', $user->id)->firstOrFail();
    
        // Ambil semua faktur yang dimiliki oleh customer dengan user_id tertentu
        $invoices = Invoice::where('customer_id', $customer->id);
    
         // Logika untuk filter
        if ($filter == 'unpaid') {
            $invoices->where('is_paid', false)
                ->whereNull('payment_receipt');
        } elseif ($filter == 'paid') {
            $invoices->where('is_paid', true);
        } elseif ($filter == 'processing') {
            $invoices->where('is_paid', false)
                ->whereNotNull('payment_receipt');
        } elseif ($filter == 'newest_due') {
            $invoices->where('is_paid', false)
                ->whereNull('payment_receipt')
                ->orderBy('due_date', 'asc');
        } elseif ($filter == 'oldest_due') {
            $invoices->orderBy('due_date', 'desc');
        }

        $invoices = $invoices->paginate(10);

        $filters = [
            'all' => 'All',
            'unpaid' => 'Unpaid',
            'paid' => 'Paid',
            'processing' => 'Processing',
            'oldest_due' => 'Oldest Due',
            'newest_due' => 'Newest Due'
        ];

        return view('user.invoice.index', compact('invoices', 'filters'));
    }
    
    



    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('user.invoice.show', compact('invoice'));
    }


    public function formPaymentReceipt(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceItems = InvoiceItem::where('invoice_id')->get();
        return view('user.invoice.upload_paymentreceipt', compact('invoice', 'invoiceItems'));
    }


    public function uploadPaymentReceipt(Invoice $invoice, Request $request)
    {
        
        $request->validate([
            'payment_receipt' => 'required|file|mimes:jpeg,jpg,pdf,png'
        ]);
    
        
       
    
       
        $file = $request->file('payment_receipt');
        $path =  time() . '_' . str_replace(' ', '_', $invoice->customer->name_unit) . '_' . $invoice->id . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));
    
        $invoice->update([
            'payment_receipt' => $path,
            'payment_time' => now()
        ]);
        alert()->success('successfully', 'Selamat Pembayaran Berhasil Terkirim');
        return redirect()->route('user.invoice.index');
    }
    

    //function untuk download invoice
    // public function downloadInvoice(string $id)
    // {
    //     $invoice = Invoice::findOrFail($id);
    //     $data = ['invoice' => $invoice];

    //     $view = view('user.invoice.show', $data)->render(); 

    //     $posStart = strpos($view, "<title>Invoice #6</title>"); 

    //     $posEnd = strpos($view, "</body>"); 

    //     $view = substr($view, $posStart, $posEnd - $posStart); 


    //     $pdf = PDF::loadHTML($view);

    //     // Set the font configuration options
    //     $pdf->setOptions([
    //         'font_path' => base_path('resources/fonts/'), // Replace with the actual path to your font files
    //         'font_family' => 'sans-serif',
    //         'font_size' => 10,
    //         'tempDir' => public_path('temp/') // Replace with the path to your temporary directory
    //     ]);

    //     $toDay = Carbon::now()->format('d-m-Y');
    //     return $pdf->download('invoice' . $invoice->id . '-' . $toDay . '.pdf');
    // }
}
