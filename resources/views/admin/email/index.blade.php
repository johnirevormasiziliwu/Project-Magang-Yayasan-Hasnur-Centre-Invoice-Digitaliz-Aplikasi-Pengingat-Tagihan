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

                            <h1 class="text-hover-primary fw-bold  text-black tex-nowrap fs-5 tex-nowrap">E-mail</h1>

                            <span class="d-block ">Akses Menu dan Informasi Penting Lainya Disini</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- End Page Header -->

        <!-- Star pencarian dan filter status invoices -->
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-3">
                <label for="keyword" class="form-label fw-bold text-black tex-nowrap fs-5 tex-nowrap">Cari</label>
                <form action="{{ route('admin.email.search') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control"
                            placeholder="Cari Invoice ID, Judul, Unit....">
                        <div class="input-group-append">
                            <button class="btn rounded-top-bottom" type="submit"
                                style="background: #6e11f4; color:#fff;">
                                <i class="bi bi-search fs-5 fw-bold text-black tex-nowrap fs-5 tex-nowrap"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <label for="#" class="form-label fs-5 fw-bold text-black tex-nowrap fs-5 tex-nowrap">Filter</label>
                <form action="{{ route('admin.email.index') }}" method="GET">
                    <select class="form-select form-select-lg fs-5 fw-bold text-black tex-nowrap fs-5 tex-nowrap" id="filter"
                        name="filter" style="background-color:#F5F5F5; color:#404040;">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="newest_due" {{ request('filter') == 'newest_due' ? 'selected' : '' }}>Newest Due
                        </option>
                        <option value="oldest_due" {{ request('filter') == 'oldest_due' ? 'selected' : '' }}>Oldest Due
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <!-- End pencarian dan filter status invoices -->

        <div class="card mt-10">
            <div class="card-body   ">
                <!-- Table -->
                <div class="table-responsive">

                    <table class="table table-borderless table-thead-bordered ">
                        <thead style="background: #F7F1FF">
                            <tr class="rounded-pill">
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">
                                    Invoice ID</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap" >
                                    Judul</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">
                                    Unit</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">Due
                                    Date</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">
                                    Status</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">
                                    Nominal</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap">
                                    Invoice</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($nomor = 1)
                            @forelse ($invoices as $invoice)

                                <tr>
                                    <td class="text-nowrap" >
                                        {{ $invoice->invoice_number }}
                                    </td>
                                    <td class="text-nowrap">{{ $invoice->title }}</td>
                                    <td class="text-nowrap" >
                                        {{ $invoice->customer->name_unit }}</td>
                                    <td class="text-nowrap" >
                                        {{ date('d-M-Y', strtotime($invoice->due_date)) }}</td>
                                    <td class="text-nowrap" >
                                        <span class="rounded"
                                            style="color: #CD412E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background: #FFEDEB; display: flex; flex-direction: row; justify-content: center; padding: 4px; gap: 10px">Unpaid</span>
                                    </td>
                                    @php($totalInvoiceNominal = 0)
                                    @foreach ($invoice->invoiceItems as $invoiceItem)
                                        @php($totalInvoiceNominal += $invoiceItem->nominal)
                                    @endforeach
                                    <td class="text-nowrap" >
                                        {{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}</td>
                                    <td style="display: flex; flex-direction: row;">
                                        {{-- <a href="{{ route('goEmail', [$invoice->id]) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-send"></i>
                                        </a> --}}
                                        <a href="{{ route('admin.viewEmail', $invoice) }}" class="btn">
                                            <i class="bi bi-send"></i></a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">
                                        <i class="bi bi-exclamation-triangle-fill d-block mx-auto my-3"
                                            style="font-size: 3rem;"></i> No Data Invoices
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- End Table -->

            </div>
        </div>

        <script>
            // start javascript sumbit filter
            document.getElementById('filter').addEventListener('change', function() {
                this.form.submit();
            });
            // end javascript sumbit filter
        </script>

</x-app-layout>
