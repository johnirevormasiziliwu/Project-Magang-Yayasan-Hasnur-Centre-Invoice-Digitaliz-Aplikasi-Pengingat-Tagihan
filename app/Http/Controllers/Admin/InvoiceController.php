<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\invoiceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $is_paid = $request->input('is_paid');
        $payment_receipt = $request->input('payment_receipt');
    
        $invoices = Invoice::query();
    
        if ($is_paid == 'unpaid') {
            $invoices->where('is_paid', false);
        } elseif ($is_paid == 'paid') {
            $invoices->where('is_paid', true);
        } elseif ($is_paid == false && $payment_receipt == true) {
            $invoices->whereNull('is_paid');
        }
    
        if (!$is_paid || $is_paid == 'all') {
            $invoices->get();
        }
    
        $filteredInvoices = $invoices->latest()->filter(request(['search']))->paginate(5)->withQueryString();
    
        return view('admin.invoice.index', [
            "invoices" => $filteredInvoices
        ]);
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $customers = Customer::all();
        $url = route('admin.invoice.store');
        return view('admin.invoice.form', compact('url', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'invoice_id' => 'required|unique:invoices,invoice_id',
            'title' => 'required|max:225',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'nominal' => 'required|numeric|min:1',
            'unit' => 'required',
            'customer_id' => 'required',
        ], [
            'customer_id.required' => 'The user field is required.',
        ]);

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menambahkan user_id ke dalam data yang akan disimpan
        $validate['user_id'] = $user->id;

        $invoice = Invoice::create($validate);
        toast('Successfully Data Invoice Ditambahkan', 'success');
        return redirect()->route('admin.invoice.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.show', compact('invoice'));
    }


    /**
     * Display the specified confirmasi resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $url = route('admin.invoice.update', $invoice);
        $customers = Customer::all();
        return view('admin.invoice.form', compact('url', 'invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:225',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'nominal' => 'required|numeric|min:1',
            'unit' => 'required', Rule::unique('invoices')->ignore($id),
            'customer_id' => 'required',
        ], [
            'customer_id.required' => 'The user field is required.',
        ]);
        $invoice = Invoice::findOrFail($id);
        $invoice->update($validate);

        toast('successfully data invoice di update', 'success');
        return redirect()->route('admin.invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function getCustomer(Request $request)
    {
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }


    public function show_payment_receipt(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.show_payment_receipt', compact('invoice'));
    }


    public function deleteConfirm(Request $request)
    {
        $invoiceIds = $request->input('invoice');
        $selectedProduks = Invoice::whereIn('id', $invoiceIds)->get();

        $action = $request->input('action');

        if ($action == 'delete') {
            Invoice::whereIn('id', $invoiceIds)->delete();
        } else if ($action == 'confirm') {

            $invoices = Invoice::whereIn('id', $invoiceIds)->get();
            return view('admin.invoice.show_payment_receipt', compact('invoices'));
        }

        alert()->success('successfully', 'Data invoice dihapus');
        return redirect()->back();
    }

    public function confirm_payment(Invoice $invoice)
    {
        $invoice->update([
            'is_paid' => true
        ]);

        alert()->success('successfully', 'Konfirmasi Pembayaran Berhasil');
        return redirect()->route('admin.invoice.index');
    }
}
