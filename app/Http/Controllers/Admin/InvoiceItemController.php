<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoiceitems = InvoiceItem::where('invoice_id', $id)->get();
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoiceitems.showinvoiceitems', compact('invoiceitems', 'invoice'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice, InvoiceItem $invoiceitem)
    {
        // Ambil data invoice item berdasarkan id dan id invoice
        $invoiceitem = InvoiceItem::where('id', $invoiceitem->id)->where('invoice_id', $invoice->id)->first();

        // Jika data invoice item tidak ditemukan
        if (!$invoiceitem) {
            return redirect()->back()->with('error', 'Invoice item not found');
        }

        // Tampilkan halaman edit invoice item dengan data yang telah diambil
        return view('admin.invoiceitems.edit', compact('invoice', 'invoiceitem'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice, InvoiceItem $invoiceitem)
    {
        // Validasi inputan form
        $validate = $request->validate([
            'description' => 'required|max:225',
            'stock' => 'required|numeric|min:1',
            'unit' => 'required',
            'price' => 'required|numeric|min:1',
            'nominal' => 'required|numeric|min:1',
            'file' => 'required',

        ]);

        $invoiceitem->update($validate);
        toast('Data Invoice Item Berhasil Update ', 'success');
        return redirect()->route('admin.invoiceitems.show', ['invoice' => $invoice->id, 'invoiceItem' => $invoiceitem->id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice, InvoiceItem $invoiceitem)
    {
        $invoiceitem = InvoiceItem::where('id', $invoiceitem->id)->where('invoice_id', $invoice->id)->first();
        $invoiceitem->delete();
        alert()->success('successfully', 'Data invoice dihapus');
        return redirect()->back();
    }
}
