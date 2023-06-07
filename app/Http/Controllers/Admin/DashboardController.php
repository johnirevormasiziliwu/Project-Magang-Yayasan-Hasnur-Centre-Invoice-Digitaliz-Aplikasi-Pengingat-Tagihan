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
        $dueDate = $now->copy()->addMonth(); 
        $oneWeekBeforeDueDate = $dueDate->copy()->subWeek(); 

        $invoicesDueThisWeek = Invoice::where('due_date', '<=', $oneWeekBeforeDueDate)
            ->where('is_paid', false)
            ->whereNull('payment_receipt')
            ->orderBy('due_date')
            ->take(3)
            ->get();

        $invoicesCount = Invoice::where('due_date', '<=', $oneWeekBeforeDueDate)
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



        $totalPaidByMonth = Invoice::join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select(DB::raw('SUM(invoice_items.nominal) as total'), DB::raw('MONTH(invoices.created_at) as month'))
            ->where('invoices.is_paid', true)
            ->where(DB::raw('MONTH(invoices.created_at)'), '>=', Carbon::now()->month)
            ->groupBy(DB::raw('MONTH(invoices.created_at)'))
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $currentMonth = Carbon::now();

        $labels = [];
        for ($i = 0; $i < 6; $i++) {
            $labels[] = $currentMonth->format('F');
            $currentMonth->addMonth();
        }




        return view('admin.dashboard', compact('invoicesDueThisWeek', 'invoicesCount', 'invoices',  'invoiceItemTotals', 'totalUnpaid', 'totalPaid', 'totalPaidByMonth', 'labels'));
    }
}
