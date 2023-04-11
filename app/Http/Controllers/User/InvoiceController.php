<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoice.index', [
            "invoices" => Invoice::latest()->filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.show', compact('invoice'));
    }


    public function form_payment_receipt(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.upload_paymentreceipt', compact('invoice'));
    }


    public function upload_payment_receipt(Invoice $invoice, Request $request)
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
