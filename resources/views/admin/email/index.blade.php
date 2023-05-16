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
                                            strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                            <path strokeLinecap="round" strokeLinejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
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


            </div>
        </div>
        <!-- End Page Header -->

        <!--  stars tombol pencarian dan filter -->
        <div class="row mt-5">
            <div class="col-5">
                <div class="container">
                    <label for="#" class="form-label fs-5 fw-bold">Cari</label>
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Cari Invoice ID, Judul, Unit...">
                            <div class="input-group-append">
                                <button class="btn  rounded-top-bottom " type="submit"
                                    style="background: #6e11f4; color:#fff;">
                                    <i class="bi bi-search fs-5 fw-bold"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- endtombol pencarian  dan filter -->

        <div class="card mt-10">
            <div class="card-body   ">
                <!-- Table -->
                <div class="table-responsive">

                    <table class="table table-borderless table-thead-bordered ">
                        <thead style="background: #F7F1FF">
                            <tr class="rounded-pill">
                                <th scope="col" class="fw-bold">Invoice ID</th>
                                <th scope="col" class="fw-bold">Judul</th>
                                <th scope="col" class="fw-bold">Unit</th>
                                <th scope="col" class="fw-bold">Due Date</th>
                                <th scope="col" class="fw-bold">Status</th>
                                <th scope="col" class="fw-bold">Nominal</th>
                                <th scope="col" class="fw-bold">Invoice</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($nomor = 1)
                            @forelse ($invoices as $invoice)
                                @if ($invoice->is_paid == false && $invoice->payment_receipt == false)
                                    <tr>
                                        <td>
                                            {{ $invoice->invoice_number }}
                                        </td>
                                        <td>{{ $invoice->title }}</td>
                                        <td>{{ $invoice->customer->name_unit }}</td>
                                        <td>{{ date('d-M-Y', strtotime($invoice->due_date)) }}</td>
                                        <td>
                                            <span class="rounded"
                                                style=" color:  #CD412E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background: #FFEDEB; display: flex; flex-direction: row; justify-content:center; padding:4px;gap:10px ">Unpaid</span>
                                        </td>
                                        @php($totalInvoiceNominal = 0)
                                        @foreach ($invoice->invoiceItems as $invoiceItem)
                                            @php($totalInvoiceNominal += $invoiceItem->nominal)
                                        @endforeach
                                        <td>{{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}</td>
                                        <td style="display: flex; flex-direction: row;">

                                            <a href="{{route('goEmail', [$invoice->id])}}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-send"></i>
                                            </a>



                                        </td>
                                    </tr>
                                @endif
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

</x-app-layout>
