<x-app-layout>
    <div class="content container-fluid bg-light">
        <!-- Page Header -->
        <div class="page mb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="card">
                                <div class="card-body">
                                    <span class="icon" style="color:#6e11f4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="flex-grow-1 ms-3">

                            <h1 class="text-hover-primary fw-bold">Invoice</h1>

                            <span class="d-block fs-3">Data-data invoice ada disini</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-auto">

                    <div class="col-sm-auto">
                        <a class="btn btn-sm text-white fw-bold" href="{{ route('user.invoice.index') }}"
                            style="background: #EFEFEF">
                            <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Page Header -->



        <div class="container">
            <div class="row">
                <div class="text-end ">
                    <a href="{{ route('user.download-invoice', $invoice) }}" class="btn fs-5"
                        style="border-color:#6e11f4; border-width:2px; color: #6e11f4;">
                        <i class="bi bi-printer"></i>
                    </a>
                    <a href="{{ route('user.download-invoice', $invoice) }}" class="btn fs-5"
                        style="border-color:#6e11f4; border-width:2px; color: #6e11f4;">
                        <i class="bi bi-download fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card mt-5">
            <div class="card-body">

                <title>Invoice #6</title>

                <style>
                    h1,
                    h2,
                    h3,
                    h4,
                    h5,
                    h6,
                    p,
                    span,
                    label {
                        font-family: sans-serif;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 0px !important;
                    }

                    table thead th {
                        height: 28px;
                        text-align: left;
                        font-size: 16px;
                        font-family: sans-serif;
                    }

                    table,
                    th,
                    td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        font-size: 14px;
                    }

                    .heading {
                        font-size: 24px;
                        margin-top: 12px;
                        margin-bottom: 12px;
                        font-family: sans-serif;
                    }

                    .small-heading {
                        font-size: 18px;
                        font-family: sans-serif;
                    }

                    .total-heading {
                        font-size: 18px;
                        font-weight: 700;
                        font-family: sans-serif;
                    }

                    .order-details tbody tr td:nth-child(1) {
                        width: 20%;
                    }

                    .order-details tbody tr td:nth-child(3) {
                        width: 20%;
                    }

                    .text-start {
                        text-align: left;
                    }

                    .text-end {
                        text-align: right;
                    }

                    .text-center {
                        text-align: center;
                    }

                    .company-data span {
                        margin-bottom: 4px;
                        display: inline-block;
                        font-family: sans-serif;
                        font-size: 14px;
                        font-weight: 400;
                    }

                    .no-border {
                        border: 1px solid #fff !important;
                    }

                    .bg-blue {
                        background-color: #414ab1;
                        color: #fff;
                    }
                </style>
                </head>

                <body>
                    @php($total = 0)
                    <table class="order-details">
                        <thead>
                            <tr>
                                <th width="50%" colspan="2">
                                    <h1 class="text-center">INVOICE</h1>
                                </th>
                                <th width="50%" colspan="2" class="text-end company-data">
                                    Invoice Id: <span class="fw-bold">{{ $invoice->invoice_number }}</span> <br>
                                    <span>Date: {{ date('d M Y', strtotime($invoice->payment_time)) }}</span> <br>
                                    <span>Address: {{ $invoice->customer->address }}</span> <br>
                                </th>
                            </tr>
                            <tr class="bg-blue">
                                <th width="50%" colspan="2">Invoice Details</th>
                                <th width="50%" colspan="2">User Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Invoice Id:</td>
                                <td>{{ $invoice->invoice_number }}</td>

                                <td>Nama Unit:</td>
                                <td>{{ $invoice->customer->name_unit }}</td>
                            </tr>
                            <tr>
                                <td>Judul Invoice</td>
                                <td>{{ $invoice->title }}</td>

                                <td>Nama PIC</td>
                                <td>{{ $invoice->customer->name_pic }}</td>
                            </tr>
                            <tr>
                                <td>Due Date:</td>
                                <td>{{ $invoice->due_date }}</td>

                                <td>Email</td>
                                <td>{{ $invoice->customer->email }}</td>
                            </tr>
                            <tr>
                                <td>Payment Date:</td>
                                @if ($invoice->payment_time)
                                  <td>{{ date('d M Y', strtotime($invoice->payment_time)) }}</td>  
                                @else
                                   <td><span class="justify-content-center">-</span></td> 
                                @endif

                                <td>No Handphone</td>
                                <td>{{ $invoice->customer->no_handphone }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                @if ($invoice->is_paid == true)
                                    <td class="bg-success text-white">Paid</td>
                                @elseif ($invoice->is_paid == false && $invoice->payment_receipt == null)
                                    <td class="bg-danger text-white text-center fw-bold">Unpaid</td>
                                @else
                                    <td class="bg-warnign text-black text-center fw-bold">Processing</td>
                                @endif

                                <td>Alamat</td>
                                <td>{{ $invoice->customer->address }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table>
                        <thead>
                            <tr>
                                <th class="no-border text-start heading" colspan="5">
                                    Detail Tagihan
                                </th>
                            </tr>
                            <tr class="bg-blue text-center">
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Uraian</th>
                                <th class="text-center">Kuantitas</th>
                                <th class="text-center">Harga(Rp)</th>
                                <th class="text-center">Jumlah(Rp)</th>

                            </tr>
                        </thead>
                        @php($nomor = 1)
                        <tbody>
                            @foreach ($invoice->invoiceItems as $item)
                                <tr>
                                    <td width="1%" class="text-center">{{ $nomor++ }}</td>
                                    <td width="20%">{{ $item->description }}</td>
                                    <td width="10%" class="text-center">{{ $item->stock }}</td>
                                    <td width="10%">{{ \App\Helper\Util::rupiah($item->price) }}</td>
                                    <td width="15%" class="fw-bold">{{ \App\Helper\Util::rupiah($item->nominal) }}
                                    </td>
                                </tr>
                                @php($total += $item->nominal)
                            @endforeach

                            <tr>
                                <td colspan="3" class="total-heading">Total Harga
                                    :</td>
                                <td colspan="1" class="total-heading">
                                    {{ \App\Helper\Util::rupiah($total) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <p class="text-center">
                        Terimakasih Kami Ucapkan, Senyuman 😊 Anda Adalah Hadiah Bagi Setiap Kinerja Kami 😍
                    </p>
                </body>

            </div>
        </div>
    </div>
</x-app-layout>
