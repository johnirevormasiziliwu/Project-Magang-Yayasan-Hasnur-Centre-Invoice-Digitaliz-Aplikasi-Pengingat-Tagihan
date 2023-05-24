<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: max-widh:100%;
            text: center;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid black;
            width: 100%
        }
    </style>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Judul</th>
                <th>Name Unit</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Nominal</th>
            </tr>
        </thead>
        @foreach ($invoices as $invoice)
            <tbody>
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->title }}</td>
                    <td>{{ $invoice->customer->name_unit }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>{{ $invoice->is_paid }}</td>
                    @php($totalInvoiceNominal = 0)
                    @foreach ($invoice->invoiceItems as $invoiceItem)
                        @php($totalInvoiceNominal += $invoiceItem->nominal)
                    @endforeach
                    <td>{{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
</body>

</html>
