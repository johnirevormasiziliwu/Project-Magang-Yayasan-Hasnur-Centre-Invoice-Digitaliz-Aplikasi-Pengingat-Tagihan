<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function createInvoiceItem(string $id)
    {
        $invoiceItems = InvoiceItem::where('invoice_id', $id)->get();
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoiceitems.addinvoiceitems', compact('invoiceItems', 'invoice'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'description' => 'required|string',
            'stock' => 'required|numeric|min:1',
            'unit' => 'required',
            'price' => 'required|numeric|min:1',
            'nominal' => 'required|numeric|min:1',
            'file' => 'required'
        ]);
        
        // ambil id invoice terbaru
        $latestInvoice = Invoice::latest()->first();
        $validate['invoice_id'] = $latestInvoice->id;
        
        InvoiceItem::create($validate);
        
        alert()->success('successfully', 'Data Tagihan Invoice Berhasil Ditambahkan');
        return redirect()->back();
    }
    
}
