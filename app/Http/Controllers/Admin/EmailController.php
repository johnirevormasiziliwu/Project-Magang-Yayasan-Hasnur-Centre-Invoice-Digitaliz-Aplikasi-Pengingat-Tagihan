<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Mail;
use App\Mail\invoiceEmail;
=======
>>>>>>> 9cc05346ba63fba3a8b6cc7f1cdddafeaa34071e

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->filter(request(['search']))->paginate(5)->withQueryString();
        $invoiceItems = InvoiceItem::where('invoice_id')->get();
        return view('admin.email.index', compact('invoices','invoiceItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        $invoiceItems = InvoiceItem::where('invoice_id', $id)->get();
        return view ('admin.email.sendemail', compact('invoice','customers','invoiceItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

<<<<<<< HEAD
    public function kirimEmail(){
 
        Mail::to("testing@digitaliz.com")->send(new invoiceEmail());
 
        return "Email telah dikirim";
 
    }

    public function goEmail(){
        Mail::to("indramusca@gmail.com")->send(new invoiceEmail());
 
        return "Email telah dikirim";
 
    }

=======
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
>>>>>>> 9cc05346ba63fba3a8b6cc7f1cdddafeaa34071e
}
