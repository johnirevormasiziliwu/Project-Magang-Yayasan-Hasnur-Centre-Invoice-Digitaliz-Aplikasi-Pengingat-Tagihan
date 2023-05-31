<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class SearchEmailController extends Controller
{
    public function searchEmail(Request $request)
    {
        $keyword = $request->input('keyword');

        $invoices = Invoice::where('is_paid', false)
            ->where(function ($query) use ($keyword) {
                $query->where('invoice_number', 'like', '%' . $keyword . '%')
                    ->orWhere('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('customer', function ($query) use ($keyword) {
                        $query->where('name_unit', 'like', '%' . $keyword . '%');
                    });
            })
            ->paginate(10);

        return view('admin.email.index', compact('invoices'));
    }
}
