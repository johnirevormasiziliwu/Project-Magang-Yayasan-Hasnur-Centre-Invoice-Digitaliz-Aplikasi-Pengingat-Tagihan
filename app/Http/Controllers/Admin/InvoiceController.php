<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $invoices = Invoice::query();



        if ($filter == 'unpaid') {
            $invoices->where('is_paid', false)
                ->whereNull('payment_receipt');
        } elseif ($filter == 'paid') {
            $invoices->where('is_paid', true);
        } elseif ($filter == 'processing') {
            $invoices->where('is_paid', false)
                ->whereNotNull('payment_receipt');
        } elseif ($filter == 'newest_due') {
            $invoices->orderBy('due_date', 'asc');
        } elseif ($filter == 'oldest_due') {
            $invoices->orderBy('due_date', 'desc');
        }

        // Logika untuk menampilkan semua faktur
        if (!$filter || $filter == 'all') {
            $invoices->get();
        }

        $filteredInvoices = $invoices->latest('invoices.created_at')->filter(request(['search']))->paginate(5)->withQueryString();

        $filters = [
            'all' => 'All',
            'unpaid' => 'Unpaid',
            'paid' => 'Paid',
            'processing' => 'Processing',
            'oldest_due' => 'Oldest Due',
            'newest_due' => 'Newest Due'
        ];

        $invoiceItems = InvoiceItem::where('invoice_id')->get();

        return view('admin.invoice.index', [
            "invoices" => $filteredInvoices,
            "filters" => $filters,
            "selectedFilter" => $filter, // nilai filter yang dipilih
            "invoiceItems" => $invoiceItems // data invoice items untuk ditampilkan pada view
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customers = Customer::all();
        $url = route('admin.invoice.store');
        return view('admin.invoice.form', compact('url', 'customers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'title' => 'required|max:225',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'customer_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $validate['user_id'] = $user->id;

            $invoice = Invoice::create($validate);

            foreach ($request->invoiceItems as $item) {
                $validator = Validator::make($item, [
                    'description' => 'required|max:255',
                    'stock' => 'required|integer',
                    'unit' => 'required|max:50',
                    'price' => 'required|numeric|min:1',
                    'nominal' => 'required|numeric|min:1',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $invoiceItem = new InvoiceItem([
                    'description' => $item['description'],
                    'stock' => $item['stock'],
                    'unit' => $item['unit'],
                    'price' => $item['price'],
                    'nominal' => $item['nominal'],
                ]);

                if (isset($item['images'])) {
                    foreach ($item['images'] as $image) {
                        $invoiceItem->addMedia($image)->toMediaCollection('images');
                    }
                }

                $invoice->invoiceItems()->save($invoiceItem);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $invoice->addMedia($image)->toMediaCollection('images');
                }
            }

            DB::commit();

            toast('Successfully Data Invoice Ditambahkan', 'success');
            return redirect()->route('admin.invoice.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Failed to add invoice data'])->withInput();
        }
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceItems = InvoiceItem::where('invoice_id', $id)->get();
        return view('admin.invoice.show', compact('invoice', 'invoiceItems'));
    }


    /**
     * Display the specified confirmasi resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        return view('admin.invoice.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'title' => 'required|max:225',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'customer_id' => 'required',
        ], [
            'customer_id.required' => 'The user field is required.',
        ]);
        $invoice = Invoice::findOrFail($id);
        $invoice->update($validate);

        toast('successfully data invoice di update', 'success');
        return redirect()->route('admin.invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function getCustomer(Request $request)
    {
        $id = $request->id;
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }


    public function show_payment_receipt(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoice.show_payment_receipt', compact('invoice'));
    }


    public function deleteConfirm(Request $request)
    {
        $invoiceIds = $request->input('invoice');
        $selectedProduks = Invoice::whereIn('id', $invoiceIds)->get();

        $action = $request->input('action');

        if ($action == 'delete') {
            Invoice::whereIn('id', $invoiceIds)->delete();
        } else if ($action == 'confirm') {

            $invoiceItems = InvoiceItem::where('invoice_id')->get();
            $invoices = Invoice::whereIn('id', $invoiceIds)->get();
            return view('admin.invoice.show_payment_receipt', compact('invoices'));
        }

        alert()->success('successfully', 'Data invoice dihapus');
        return redirect()->back();
    }

    // function untuk confirmasi pembayaran
    public function confirm_payment(Invoice $invoice)
    {
        $invoice->update([
            'is_paid' => true
        ]);

        alert()->success('successfully', 'Konfirmasi Pembayaran Berhasil');
        return redirect()->route('admin.invoice.index');
    }

    // function untuk download gambar payment_receipt
    public function downloadPaymentReceipt(Invoice $invoice)
    {
        $path = 'public/' . $invoice->payment_receipt;
        return Storage::download($path);
    }

    //function untuk download invoice
    public function downloadInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
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

        $toDay = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoice->id . '-' . $toDay . '.pdf');

    }

    public function generatePdfInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
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

        $toDay = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice' . $invoice->id . '-' . $toDay . '.pdf');
    }
}
