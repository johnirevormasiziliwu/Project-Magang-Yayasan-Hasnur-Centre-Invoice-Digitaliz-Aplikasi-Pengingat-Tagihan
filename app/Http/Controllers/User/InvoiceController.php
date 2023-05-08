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
    
        // Tambahkan logika filter seperti yang Anda lakukan sebelumnya
        if ($filter == 'unpaid') {
            $invoices->where('is_paid', false)
                ->whereNull('payment_receipt');
        } elseif ($filter == 'paid') {
            $invoices->where('is_paid', true);
        } elseif ($filter == 'processing') {
            $invoices->where('is_paid', false)
                ->whereNotNull('payment_receipt');
        } elseif ($filter == 'oldest_due') {
            $invoices->orderBy('due_date', 'asc');
        } elseif ($filter == 'newest_due') {
            $invoices->orderBy('due_date', 'desc');
        }
    
        // Logika untuk menampilkan semua faktur
        if (!$filter || $filter == 'all') {
            $invoices->get();
        }
    
        $filteredInvoices = $invoices->latest()->filter(request(['search']))->paginate(5)->withQueryString();
    
        $filters = [
            'all' => 'All', // nilai dan label untuk 'all'
            'unpaid' => 'Unpaid', // nilai dan label untuk 'unpaid'
            'paid' => 'Paid', // nilai dan label untuk 'paid'
            'processing' => 'Processing', // nilai dan label untuk 'processing'
            'oldest_due' => 'Oldest Due', // nilai dan label untuk 'oldest_due'
            'newest_due' => 'Newest Due' // nilai dan label untuk 'newest_due'
        ];
    
        $invoiceItems = InvoiceItem::where('invoice_id')->get();
    
        return view('user.invoice.index', [
            "invoices" => $filteredInvoices,
            "filters" => $filters,
            "selectedFilter" => $filter, // nilai filter yang dipilih
            'invoiceItems' => $invoiceItems,
        ]);
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
        // Validate the uploaded file
        $request->validate([
            'payment_receipt' => 'required|file|mimes:jpeg,jpg,pdf,png'
        ]);

        // Process the uploaded file
        $file = $request->file('payment_receipt');
        $path = time() . '_' . str_replace(' ', '_', $invoice->customer->name_unit) . '_' . $invoice->id . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/paymentreceipt/paymentreceipt' . $path, file_get_contents($file));

        $invoice->update([
            'payment_receipt' => $path,
            'payment_time' => now()
        ]);
        toast('Succsess Bukti Pembayaran Telah Terkirim', 'success');
        return redirect()->route('user.invoice.index');
    }

    //function untuk download invoice
    public function downloadInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $data = ['invoice' => $invoice];

        $view = view('user.invoice.show', $data)->render(); 

        $posStart = strpos($view, "<title>Invoice #6</title>"); 

        $posEnd = strpos($view, "</body>"); 

        $view = substr($view, $posStart, $posEnd - $posStart); 


        $pdf = PDF::loadHTML($view);

        // Set the font configuration options
        $pdf->setOptions([
            'font_path' => base_path('resources/fonts/'), // Replace with the actual path to your font files
            'font_family' => 'sans-serif',
            'font_size' => 10,
            'tempDir' => public_path('temp/') // Replace with the path to your temporary directory
        ]);

        $toDay = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoice->id . '-' . $toDay . '.pdf');
    }
}
