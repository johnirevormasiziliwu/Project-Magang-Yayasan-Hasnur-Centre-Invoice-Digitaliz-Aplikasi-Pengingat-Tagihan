<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $now = Carbon::now();
        $oneWeekAhead = $now->copy()->addWeek();

        // Menampilkan data transaski yang tagihan minggu ini
        $invoicesDueThisWeek = Invoice::whereBetween('due_date', [$now, $oneWeekAhead])
            ->where('is_paid', false)
            ->whereNull('payment_receipt')
            ->orderBy('due_date')
            ->take(3)
            ->get();

        // Menampilkan jumlah transaksi yang di tagih minggu ini
        $invoicesCount = Invoice::whereBetween('due_date', [$now, $oneWeekAhead])
            ->where('is_paid', false)
            ->whereNull('payment_receipt')
            ->count();

            $invoices = Invoice::paginate(10)->withQueryString();

        return view('admin.dashboard', compact('invoicesDueThisWeek', 'invoicesCount',  'invoices'));
    }
}
