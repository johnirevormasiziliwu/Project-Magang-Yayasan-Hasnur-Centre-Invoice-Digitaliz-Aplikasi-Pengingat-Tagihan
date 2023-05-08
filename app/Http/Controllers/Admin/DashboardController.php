<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
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

        // Memperbarui kode untuk menghitung total invoice item dari setiap invoice
        $invoiceItemTotals = [];
        foreach ($invoices as $invoice) {
            $total = $invoice->invoiceItems->sum('nominal');
            $invoiceItemTotals[$invoice->id] = $total;
        }

        // Menghitung total invoice item dengan status unpaid dan paid
        $totalUnpaid = Invoice::where('is_paid', false)
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->sum('invoice_items.nominal');

        $totalPaid = Invoice::where('is_paid', true)
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->sum('invoice_items.nominal');

        return view('admin.dashboard', compact('invoicesDueThisWeek', 'invoicesCount', 'invoices', 'invoiceItemTotals', 'totalUnpaid', 'totalPaid'));
    }
}
