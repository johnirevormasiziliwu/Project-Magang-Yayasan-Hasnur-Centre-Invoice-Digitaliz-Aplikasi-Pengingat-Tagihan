<!DOCTYPE html>
<html>

<head>
    <title>Laporan Invoice</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 3.5cm;
            margin-bottom: 3.5cm;
            margin-left: 1cm;
            margin-right: 1cm;
            z-index: -1;
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .subtitle {
            text-align: center;
            text-decoration: underline;
        }

        
    </style>
</head>

<body>
    <h2 class="subtitle">INVOICE DIGITALIZ</h2>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Judul</th>
                <th>Nama Unit</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
        </thead>
        @foreach ($invoices as $invoice)
            <tbody>
                <tr>
                    <td style="width: 35%;">{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->title }}</td>
                    <td>{{ $invoice->customer->name_unit }}</td>
                    <td style="width: 30%; text-align: center" >{{ $invoice->due_date }}</td>
                    @if ($invoice->is_paid == true)
                        <td>
                            <span class="rounded"
                                style=" text-align: center; border-radius: 4px; color: #1a251f; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background: #D4F1E0; display: flex; flex-direction: row; justify-content:center; padding:4px;gap:10px ">Paid</span>
                        </td>
                    @elseif ($invoice->is_paid == false && $invoice->payment_receipt == null)
                        <td>
                            <span class="rounded"
                                style=" text-align: center; border-radius: 4px; color: #CD412E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFEDEB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Unpaid</span>
                        </td>
                    @else
                        <td>
                            <span class="rounded"
                                style=" text-align: center;  color: #CD7B2E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFF7EB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Processing</span>
                        </td>
                    @endif
                    @php($totalInvoiceNominal = 0)
                    @foreach ($invoice->invoiceItems as $invoiceItem)
                        @php($totalInvoiceNominal += $invoiceItem->nominal)
                    @endforeach
                    <td style="width: 80%;">{{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}</td>
                </tr>

            </tbody>
        @endforeach
    </table>
</body>

</html>
