<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $oneWeekAhead = $now->copy()->addWeek();
        $oneWeekBeforeDueDate = $oneWeekAhead->copy()->subWeek();
        
        // Menampilkan data transaksi yang jatuh tempo satu minggu sebelum tanggal sekarang
        $invoicesDueThisWeek = Invoice::whereBetween('due_date', [$oneWeekBeforeDueDate, $oneWeekAhead])
            ->where('is_paid', false)
            ->whereNull('payment_receipt')
            ->orderBy('due_date')
            ->take(3)
            ->get();
        
        // Menampilkan jumlah transaksi yang jatuh tempo satu minggu sebelum tanggal sekarang
        $invoicesCount = Invoice::whereBetween('due_date', [$oneWeekBeforeDueDate, $oneWeekAhead])
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



        // Menghitung total nominal keseluruhan invoice yang sudah dibayar berdasarkan bulan
        $totalPaidByMonth = Invoice::join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select(DB::raw('SUM(invoice_items.nominal) as total'), DB::raw('MONTH(invoices.created_at) as month'))
            ->where('invoices.is_paid', true)
            ->groupBy(DB::raw('MONTH(invoices.created_at)'))
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $currentMonth = Carbon::now()->format('F');
        $labels = [];
        for ($i = 0; $i < 6; $i++) {
            $labels[] = Carbon::now()->addMonths($i)->format('F');
        }




        return view('admin.dashboard', compact('invoicesDueThisWeek', 'invoicesCount', 'invoices',  'invoiceItemTotals', 'totalUnpaid', 'totalPaid', 'totalPaidByMonth', 'labels'));
    }
}
