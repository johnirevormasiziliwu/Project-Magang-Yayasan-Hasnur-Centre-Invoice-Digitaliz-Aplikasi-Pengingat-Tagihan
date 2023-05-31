<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class SearchInvoiceController extends Controller
{
    public function searchInvoice(Request $request)
    {
        $keyword = $request->input('keyword');
      

        $invoices = Invoice::where('invoice_number', 'like', '%' . $keyword . '%')
            ->orWhere('title', 'like', '%' . $keyword . '%')
            ->orWhereHas('customer', function ($query) use ($keyword) {
                $query->where('name_unit', 'like', '%' . $keyword . '%');
            });
            $invoices = $invoices->paginate(10);
            

        return view('admin.invoice.index', compact('invoices'));
    }
}
