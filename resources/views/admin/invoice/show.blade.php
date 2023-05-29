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
                        <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.invoice.index') }}"
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
                    <a href="{{ route('admin.print-invoice', $invoice) }}" class="btn fs-5"
                        style="border-color:#6e11f4; border-width:2px; color: #6e11f4;">
                        <i class="bi bi-printer"></i>
                    </a>
                    <a href="{{ route('admin.download-invoice', $invoice) }}" class="btn fs-5"
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
                    .unpaid {
                        text-align: right;
                        font-weight: bold;
                        font-size: 30px;
                        margin-bottom: 20px;
                        text-decoration: underline;
                        color: red;
                        text-decoration-color: black;
                    }

                    .paid {
                        text-align: right;
                        font-weight: bold;
                        font-size: 30px;
                        margin-bottom: 20px;
                        text-decoration: underline;
                        color: green;
                        text-decoration-color: black;
                    }

                    .processing {
                        text-align: right;
                        font-weight: bold;
                        font-size: 30px;
                        margin-bottom: 20px;
                        text-decoration: underline;
                        color: orange;
                        text-decoration-color: black;
                    }

                    .invoice {
                        text-align: center;
                        font-weight: bold;
                        font-size: 18px;
                        margin-bottom: 20px;
                        letter-spacing: 5px;
                        text-decoration: underline;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th,
                    td {
                        padding: 5px;
                        border: 1px solid black;
                    }

                    .header {
                        text-align: center;
                        font-weight: bold;
                        font-size: 24px;
                        padding: 10px;
                    }

                    .address {
                        width: 350px;
                    }

                    .title {
                        font-weight: bold;
                        font-size: 18px;
                        padding: 10px 0;
                    }

                    .dokumen_pendukung {
                        text-align: center;
                    }

                    .keterangan th {
                        font-weight: 900;
                        text-align: center;
                    }

                    .subtotal {

                        height: 80px;

                    }

                    .total {
                        text-align: center;
                        font-weight: bold;
                    }

                    .terbilang {
                        font-family: "Bookman Old Style", serif;
                        ;

                    }


                    .note {
                        font-size: 12px;
                    }
                </style>
                </head>

                <?php
                function terbilang($angka)
                {
                    $angka = abs($angka);
                    $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
                    $terbilang = '';
                    if ($angka < 12) {
                        $terbilang = ' ' . $huruf[$angka];
                    } elseif ($angka < 20) {
                        $terbilang = terbilang($angka - 10) . ' Belas';
                    } elseif ($angka < 100) {
                        $terbilang = terbilang($angka / 10) . ' Puluh' . terbilang($angka % 10);
                    } elseif ($angka < 200) {
                        $terbilang = ' Seratus' . terbilang($angka - 100);
                    } elseif ($angka < 1000) {
                        $terbilang = terbilang($angka / 100) . ' Ratus' . terbilang($angka % 100);
                    } elseif ($angka < 2000) {
                        $terbilang = ' Seribu' . terbilang($angka - 1000);
                    } elseif ($angka < 1000000) {
                        $terbilang = terbilang($angka / 1000) . ' Ribu' . terbilang($angka % 1000);
                    } elseif ($angka < 1000000000) {
                        $terbilang = terbilang($angka / 1000000) . ' Juta' . terbilang($angka % 1000000);
                    } elseif ($angka < 1000000000000) {
                        $terbilang = terbilang($angka / 1000000000) . ' Miliar' . terbilang(fmod($angka, 1000000000));
                    } elseif ($angka < 1000000000000000) {
                        $terbilang = terbilang($angka / 1000000000000) . ' Triliun' . terbilang(fmod($angka, 1000000000000));
                    }
                    return $terbilang;
                }
                
                $invoiceItems = $invoice->invoiceItems;
                $total = 0;
                foreach ($invoiceItems as $invoiceitem) {
                    $total += $invoiceitem->nominal;
                }
                
                $terbilang = terbilang($total);
                ?>

                <body>

                    @php($total = 0)
                    @if ($invoice->is_paid == false && $invoice->payment_receipt == null)
                        <div class="unpaid">UNPAID</div>
                    @elseif($invoice->is_paid == true)
                        <div class="paid">PAID</div>
                    @else
                        <div class="processing">PROCESSING</div>
                    @endif
                    <div class="invoice">INVOICE</div>

                    <table>

                        <tr>
                            <td rowspan="3">
                                <p class="mt-3">Kepada :</p>
                                <h3 class="name_unit">{{ $invoice->customer->name_unit }}</h3>
                                <p class="address">{{ $invoice->customer->address }}</p>
                                <p class="mt-5 mb-5">UP: Bagian Keuangan</p>
                            </td>
                            <td colspan="5">
                                No Invoice: {{ $invoice->invoice_number }} <br>
                                Tanggal Invoice: {{ $invoice->invoice_date }} <br>
                                Tanggal Jatuh Tempo: {{ $invoice->due_date }} <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="dokumen_pendukung">Dokumen Pendukung</td>
                        </tr>
                        <tr>
                            <td colspan="2">Dokumen : <br> {{ $invoice->title }}</td>
                            <td colspan="3">Tanggal :</td>
                        </tr>
                        <tr class="keterangan">
                            <th>Uraian</th>
                            <th>Kuantitas</th>
                            <th>Harga (Rp)</th>
                            <th>Jumlah (Rp)</th>
                        </tr>
                        @php($total = 0)
                        @foreach ($invoice->invoiceItems as $invoiceitem)
                            <tr>
                                <td>{{ $invoiceitem->description }}</td>
                                <td class="text-center">{{ $invoiceitem->stock }}</td>
                                <td class="text-center">{{ \App\Helper\Util::rupiah($invoiceitem->price) }}</td>
                                <td class="text-center">{{ \App\Helper\Util::rupiah($invoiceitem->nominal) }}</td>
                            </tr>
                            @php($total += $invoiceitem->nominal)
                        @endforeach
                        <tr>
                            <td class="subtotal" colspan="3">TOTAL</td>
                            <td class="total" colspan="3">{{ \App\Helper\Util::rupiah($total) }}</td>
                        </tr>


                        <tr>
                            <td colspan="6" class="terbilang">
                                <strong>TERBILANG</strong><br>
                                <p style="text-align: center; padding-top: 20px;"><?php echo $terbilang; ?> Rupiah</p>
                            </td>
                        </tr>
                    </table>


                    Note:<br>
                    1. Pembayaran ini mohon ditransfer ke rekening:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Bank Mandiri Kayutangi<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;No. Rek. 031 00 404 78888<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;a/n. Yayasan Hasnur Centre<br>
                    2. Mohon mencantumkan nama perusahaan anda dan no.invoice saat mentransfer
                    pembayaran.<br>
                    3. Bukti pembayaran (bukti transfer) harap di email ke siti.aisyah@hasnurgroup.com<br>
                    <br>
                    <span style="float: right;">YAYASAN HASNUR CENTRE</span>
                    <br><br>
                    <span style="float:right;">Yani Hadiyani</span> <br>
                    <span style="float:right;">Finance Manager</span>



                </body >


            </div>
        </div>
    </div>
</x-app-layout>
