<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CetakController extends Controller
{
    public function downloadInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = Pdf::loadView('admin.cetak.download', compact('invoice'));
        $toDay = Carbon::now()->format('d-m-Y');
        return $pdf->download('Tagihan invoice ' . $invoice->customer->name_unit . ' ' . $toDay . '.pdf');

    }

    public function printInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = Pdf::loadView('admin.cetak.download', compact('invoice'));
        $toDay = Carbon::now()->format('d-m-Y');
        return $pdf->download('Tagihan invoice ' . $invoice->customer->name_unit . ' ' . $toDay . '.pdf');

    }

    public function printAll()
    {
        $invoices = Invoice::all();
        $pdf = Pdf::loadView('admin.cetak.print', compact('invoices'));
        return $pdf->download('Laporan Invoice Digitaliz.pdf');
    }


}
