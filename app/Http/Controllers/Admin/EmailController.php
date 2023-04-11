<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $data = [
            'invoices' => Invoice::latest()->filter(request(['search']))->paginate(5)->withQueryString()
        ];
        return view('admin.email.index', $data);
    }

    public function delete(Request $request) {
        $invoice = $request->input('invoice');
        Invoice::whereIn('id', $invoice)->delete();
        alert()->success('successfully', 'Data Email Invoice Berhasil Di Hapus');
        return redirect()->back();
    }

    public function sendEmail(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        return view('admin.email.sendemail', compact('invoice', 'customers'));
    }
}
