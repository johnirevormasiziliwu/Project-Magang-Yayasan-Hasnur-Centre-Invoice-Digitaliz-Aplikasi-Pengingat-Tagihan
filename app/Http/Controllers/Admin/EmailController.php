<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\invoiceEmail;
use App\Notifications\InvoicePaidNotification;
use Illuminate\Support\Facades\Notification;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $invoices = Invoice::query();

        if ($filter == 'newest_due') {
            $invoices->where('is_paid', false)
                ->orderBy('due_date', 'asc');
        } elseif ($filter == 'oldest_due') {
            $invoices->where('is_paid', false)
                ->orderBy('due_date', 'desc');
        } else {
            $invoices->where('is_paid', false);
        }

        $invoices = $invoices->get();

        $filters = [
            'all' => 'All',
            'newest_due' => 'Newest Due',
            'oldest_due' => 'Oldest Due',
        ];

        return view('admin.email.index', compact('invoices', 'filters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function viewEmail(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        $invoiceItems = InvoiceItem::where('invoice_id', $id)->get();
        $nmrwa = $this->formatHp($invoice->customer->no_handphone);
        return view ('admin.email.sendemail', compact('invoice','customers','invoiceItems','nmrwa'));
    }

    public function formatHp($nohp){
        $hp = $nohp;
         // kadang ada penulisan no hp 0811 239 345
         $nohp = str_replace(" ","",$nohp);
         // kadang ada penulisan no hp (0274) 778787
         $nohp = str_replace("(","",$nohp);
         // kadang ada penulisan no hp (0274) 778787
         $nohp = str_replace(")","",$nohp);
         // kadang ada penulisan no hp 0811.239.345
         $nohp = str_replace(".","",$nohp);
     
         // cek apakah no hp mengandung karakter + dan 0-9
         if(!preg_match('/[^+0-9]/',trim($nohp))){
             // cek apakah no hp karakter 1-3 adalah +62
             if(substr(trim($nohp), 0, 3)=='+62'){
                 $hp = trim($nohp);
             }
             // cek apakah no hp karakter 1 adalah 0
             elseif(substr(trim($nohp), 0, 1)=='0'){
                 $hp = '+62'.substr(trim($nohp), 1);
             }
         }else{
            $hp = $nohp;
         }
         return $hp;
     }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    // public function kirimEmail()
    // {

    //     Mail::to("testing@digitaliz.com")->send(new invoiceEmail());

    //     return "Email telah dikirim";
    // }

    public function markInvoiceAsPaid($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $total = $invoice->invoiceItems()->sum('nominal');
        // return response()->json($total);
        $total = \App\Helper\Util::rupiah($total);

        // Mark the invoice as paid

        // Dispatch the notification
        Notification::send($invoice->user, new InvoicePaidNotification($invoice, $total));
        toast('Email Berhasil Dikirim', 'success');
        return redirect()->route('admin.email.index');
    }

    public function goEmail($invoice)
    {

        $invoice = Invoice::where('id', $invoice)->first();
        $tagihan = InvoiceItem::where('invoice_id', $invoice->id)->sum('nominal');

        $data = ['invoice' => $invoice];

        $view = view('admin.invoice.show', $data)->render();

        $posStart = strpos($view, "<title>Invoice #6</title>");

        $posEnd = strpos($view, "</body>");

        $view = substr($view, $posStart, $posEnd - $posStart);


        $pdf = PDF::loadHTML($view);

        // Set the font configuration options
        $pdf->setOptions([
            'font_path' => base_path('resources/fonts/'), // Replace with the actual path to your font files
            'font_family' => 'sans-serif',
            'font_size' => 10,
            'tempDir' => public_path('temp/') // Replace with the path to your temporary directory
        ]);

        $path = time();
        $pdf->save(public_path('temp/'.$path.'.pdf'));

        $mailData = array(
                   'nama'           => $invoice->user->name,
                   'judul'          => $invoice->title,
                   'invoice_number' => $invoice->invoice_number,
                   'due_date'       => $invoice->due_date,
                   'tagihan'        => 'Rp.'.$tagihan,
                   'path'           => $path,
                  );

        Mail::to("user@digitaliz.id")->send(new invoiceEmail($mailData));

        return "Email telah dikirim";
    }

   


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
