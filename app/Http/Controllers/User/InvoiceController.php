<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $invoices = Invoice::query();

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

        return view('user.invoice.index', [
            "invoices" => $filteredInvoices,
            "filters" => $filters,
            "selectedFilter" => $filter // nilai filter yang dipilih
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
        return view('user.invoice.upload_paymentreceipt', compact('invoice'));
    }


    public function uploadPaymentReceipt(Invoice $invoice, Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'payment_receipt' => 'required|file|mimes:jpeg,jpg,pdf,png'
        ]);

        // Process the uploaded file
        $file = $request->file('payment_receipt');
        $path = time() . '_' . $invoice->id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $invoice->update([
            'payment_receipt' => $path,
            'payment_time' => now()
        ]);
        toast('Succsess Bukti Pembayaran Telah Terkirim', 'success');
        return redirect()->route('user.invoice.index');
    }
}
