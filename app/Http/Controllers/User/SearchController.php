<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');


        $user = $request->user();


        $customer = Customer::where('user_id', $user->id)->firstOrFail();

        $invoices = Invoice::where('customer_id', $customer->id)
            ->where(function ($query) use ($keyword) {
                $query->where('invoice_number', 'like', '%' . $keyword . '%')
                    ->orWhere('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('customer', function ($query) use ($keyword) {
                        $query->where('name_unit', 'like', '%' . $keyword . '%');
                    });
            })
            ->paginate(10);

        return view('user.invoice.index', compact('invoices'));
    }
}
