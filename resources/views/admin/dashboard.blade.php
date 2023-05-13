<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
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
                                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="flex-grow-1 ms-3">

                            <h1 class="text-hover-primary fw-bold">Dashboard</h1>

                            <span class="d-block fs-3">Akses menu dan informasi penting lainnya di sini</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-auto">

                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.invoice.create') }}"
                        style="background: #6e11f4">
                        <i class="bi bi-plus fs-4"></i> Buat Invoice
                    </a>

                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Card -->
        <div class="card">
            <div class="card-body d-flex justify-content-around">
                @php($nomor = 1)
                <div class="paid">
                    <p class="fs-5 fw-bold text-success">
                        <i class="bi bi-check-circle-fill me-2 text-success fw-bold fs-5"></i>
                        Paid Bill
                    </p>
                    <h1 class="fw-bold">
                        {{ \App\Helper\Util::rupiah($totalPaid) }}
                    </h1>
                </div>
                <hr
                    style="border-right: 2px solid #E0E0E0; height: 50px; position: absolute; top: 0; left:30%; transform: translateX(50%);">
                <div class="unpaid text-center">
                    <p class="text-danger fw-bold text-danger fs-5">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        Unpaid Bill
                    </p>
                    <h1 class="fw-bold">
                        {{ \App\Helper\Util::rupiah($totalUnpaid) }}
                    </h1>
                </div>
                <hr
                    style="border-right: 2px solid #E0E0E0; height: 50px; position: absolute; top: 0; right:30%; transform: translateX(50%);">
                <div class="paid text-right">
                    <p class="text-warning fw-bold fs-5">
                        <i class="bi bi-exclamation-circle-fill me-2 text-warning "></i>
                        Reminder Bill
                    </p>
                    <h1 class="fw-bold">
                        {{ $invoicesCount }} invoice


                    </h1>
                </div>
            </div>
        </div>


        <!-- End Card -->
        <div class="row mt-4">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <span class="h3 mb-0">Total Transaksi</span>
                        </div>
                        <!-- Bar Chart -->
                        <div class="chartjs-custom">
                            <canvas id="ecommerce-sales" class="js-chart" style="height: 20rem; width: 25rem;"
                                data-hs-chartjs-options='{
                              "type": "bar",
                              "data": {
                                "labels": ["Okt", "Nov", "Des", "Jan", "Feb", "Maret"],
                                "datasets": [{
                                  "data": [100, 200, 300, 400, 500,600],
                                  "backgroundColor": "#6E11F4",
                                  "hoverBackgroundColor": "#6E11F4",
                                  "borderColor": "#6E11F4",
                                  "maxBarThickness": "100",
                                  "borderRadius": 10
                                }]
                              },
                              "options": {
                                "scales": {
                                  "y": {
                                    "grid": {
                                      "color": "#e7eaf3",
                                      "drawBorder": false,
                                      "zeroLineColor": "#e7eaf3"
                                    },
                                    "ticks": {
                                      "beginAtZero": true,
                                      "stepSize": 100,
                                      "fontSize": 12,
                                      "fontColor": "#97a4af",
                                      "fontFamily": "Open Sans, sans-serif",
                                      "padding": 10,
                                      "postfix": "$"
                                    }
                                  },
                                  "x": {
                                    "grid": {
                                      "display": false,
                                      "drawBorder": false
                                    },
                                    "ticks": {
                                      "font": {
                                        "size": 12,
                                        "family": "Open Sans, sans-serif"
                                      },
                                      "color": "#97a4af",
                                      "padding": 5
                                    },
                                    "categoryPercentage": 0.5
                                  }
                                },
                                "cornerRadius": 2,
                                "plugins": {
                                  "tooltip": {
                                    "prefix": "$",
                                    "hasIndicator": true,
                                    "mode": "index",
                                    "intersect": false
                                  }
                                },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": true
                                }
                              }
                            }'></canvas>
                        </div>


                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Due This Week</h3>
                        @if (count($invoicesDueThisWeek) > 0)
                            @foreach ($invoicesDueThisWeek as $invoice)
                                <div class="row mt-5 ">
                                    <div class="col">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar  avatar-circle"
                                                    style="background: #6e11f4; color:#fff">
                                                    <span class="avatar-initials">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            style="width: 1.5rem; height: 1.5rem; margin: 0.25rem;">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <span
                                                    class="d-block h5 text-inherit mb-0">{{ $invoice->customer->name_unit }}</span>
                                                <span
                                                    class="d-block font-size-sm text-body mt-2">{{ date('d M Y', strtotime($invoice->due_date)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span class="fw-bold fs-5"
                                            style="color:#9E9E9E;">{{ \App\Helper\Util::rupiah($invoiceItemTotals[$invoice->id]) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- kode HTML untuk menampilkan pesan "No data" di dalam card -->
                            <div class="text-center mt-10 ">
                                <p class="text-muted">Tidak Ada Tagihan Minggu Ini</p>
                            </div>
                        @endif

                        <div class="d-grid gap-2 mt-10">
                            @if (count($invoicesDueThisWeek) > 0)
                                <a href="{{ route('admin.invoice.index') }}" class="btn fw-bold fs-5" type="button"
                                    style="background: #F3ECFF; color:#6e11f4">
                                    Lihat Selengkapnya <i class="bi bi-arrow-right fw-bold fs-5"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered">
                        <thead style="background: #F7F1FF">
                            <tr class="rounded-pill">
                                <th scope="col" class="fw-bold">Invoice ID</th>
                                <th scope="col" class="fw-bold">Unit</th>
                                <th scope="col" class="fw-bold">Payment Date</th>
                                <th scope="col" class="fw-bold">Due Date</th>
                                <th scope="col" class="fw-bold">Status</th>
                                <th scope="col" class="fw-bold">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($nomor = 1)
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.invoice.show', $invoice) }}">
                                            {{ $invoice->invoice_number }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->customer->name_unit }}</td>
                                    <td>
                                        @if ($invoice->payment_time)
                                            {{ date('d M Y', strtotime($invoice->payment_time)) }}
                                        @else
                                            <span class="justify-content-center">-</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($invoice->due_date)) }}</td>
                                    @if ($invoice->is_paid == true)
                                        <td>
                                            <span class="rounded"
                                                style="border-radius: 4px; color: #1a251f; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background: #D4F1E0; display: flex; flex-direction: row; justify-content:center; padding:4px; gap:10px ">Paid</span>
                                        </td>
                                    @elseif ($invoice->is_paid == false && $invoice->payment_receipt == null)
                                        <td>
                                            <span class="rounded"
                                                style="border-radius: 4px; color: #CD412E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFEDEB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Unpaid</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="rounded"
                                                style="color: #CD7B2E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFF7EB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Processing</span>
                                        </td>
                                    @endif
                                    <td>{{ \App\Helper\Util::rupiah($invoiceItemTotals[$invoice->id]) }}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td class="text-center fs-4 fw-bold">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <!-- Stars Menu Pagination-->
                <div class="d-flex justify-content-center mt-5">
                    {{ $invoices->links() }}
                </div>
                <!-- End Menu Pagination-->

            </div>
        </div>

    </div>

    <script>
        (function() {
            // INITIALIZATION OF CHARTJS
            // =======================================================
            document.querySelectorAll('.js-chart').forEach(item => {
                HSCore.components.HSChartJS.init(item)
            })
        })();

        var adaTotalTransaksi = false; // Ubah menjadi true jika ada total transaksi
        var warnaBatang = adaTotalTransaksi ? "#6E11F4" :
            "#DECBFB"; // Warna batang berdasarkan ada atau tidak adanya total transaksi

        // Mendapatkan referensi ke elemen canvas grafik
        var canvas = document.getElementById("ecommerce-sales");

        // Mengambil data konfigurasi grafik dari atribut data-hs-chartjs-options
        var chartConfig = JSON.parse(canvas.getAttribute("data-hs-chartjs-options"));

        // Mengatur warna batang berdasarkan ada atau tidak adanya total transaksi
        chartConfig.data.datasets[0].backgroundColor = warnaBatang;
        chartConfig.data.datasets[0].hoverBackgroundColor = warnaBatang;
        chartConfig.data.datasets[0].borderColor = warnaBatang
    </script>
</x-app-layout>
