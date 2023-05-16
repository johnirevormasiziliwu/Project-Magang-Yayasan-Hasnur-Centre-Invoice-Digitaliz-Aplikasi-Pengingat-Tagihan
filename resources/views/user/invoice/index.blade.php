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
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
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
        <div class="filter-search">
            <div class="row">
                <div class="col-md-4">
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
                <div class="col-md-4">

                    <form action="{{ route('user.invoice.index') }}" method="get">
                        <label for="#" class="form-label fs-5 fw-bold">Filter</label>
                        <select name="filter" id="filter" class="form-select fw-bold">
                            <option value="all" {{ $selectedFilter == 'all' ? 'selected' : '' }}>
                                All</option>
                            <option value="unpaid" {{ $selectedFilter == 'unpaid' ? 'selected' : '' }}>Unpaid
                            </option>
                            <option value="paid" {{ $selectedFilter == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="processing" {{ $selectedFilter == 'processing' ? 'selected' : '' }}>
                                Processing</option>
                            <option value="newest_due" {{ $selectedFilter == 'newest_due' ? 'selected' : '' }}>
                                Newset
                                Due</option>
                            <option value="oldest_due" {{ $selectedFilter == 'oldest_due' ? 'selected' : '' }}>
                                Oldest
                                Due</option>
                        </select>
                    </form>



                </div>
            </div>
        </div>
        <!-- endtombol pencarian  dan filter -->


        <div class="card mt-10">
            <div class="card-body ">
                <!-- Table -->
                <div class="table-responsive">

                    <table class="table table-borderless table-thead-bordered ">
                        <thead style="background: #F7F1FF">
                            <tr class="rounded-pill">
                                <th scope="col" class="fw-bold">Invoice ID</th>
                                <th scope="col" class="fw-bold">Judul</th>
                                <th scope="col" class="fw-bold">Unit</th>
                                <th scope="col" class="fw-bold">Due Date <i
                                        class="bi bi-chevron-expand ms-2  fs-5 fw-bold"></i></th>
                                <th scope="col" class="fw-bold">Status</th>
                                <th scope="col" class="fw-bold">Nominal</th>
                                <th scope="col" class="fw-bold">Invoice</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($nomor = 1)
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>

                                        <a href="{{ route('user.invoice.show', $invoice) }}">
                                            <u>{{ $invoice->invoice_number }}</u>
                                        </a>
                                    </td>
                                    <td>{{ $invoice->title }}</td>
                                    <td>{{ $invoice->customer->name_unit }}</td>
                                    <td>{{ date('d-M-Y', strtotime($invoice->due_date)) }}</td>

                                    @if ($invoice->is_paid == true)
                                        <td>
                                            <span class="rounded"
                                                style=" border-radius: 4px; color: #1a251f; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background: #D4F1E0; display: flex; flex-direction: row; justify-content:center; padding:4px;gap:10px ">Paid</span>
                                        </td>
                                    @elseif ($invoice->is_paid == false && $invoice->payment_receipt == null)
                                        <td>
                                            <span class="rounded"
                                                style=" border-radius: 4px; color: #CD412E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFEDEB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Unpaid</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="rounded"
                                                style="  color: #CD7B2E; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%; background:  #FFF7EB; display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Processing</span>
                                        </td>
                                    @endif
                                    @php($totalInvoiceNominal = 0)
                                    @foreach ($invoice->invoiceItems as $invoiceItem)
                                        @php($totalInvoiceNominal += $invoiceItem->nominal)
                                    @endforeach
                                    <td>{{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}</td>
                                    <td style="display: flex; flex-direction: row;">

                                        <a href="{{ route('user.payment-receipt', $invoice) }}" class="nav-icon" style="color:#404040;">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                                <path strokeLinecap="round" strokeLinejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>

                                        </a>

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


            <!-- Stars Menu Pagination-->
            <div class="d-flex justify-content-center mt-5">
                {{ $invoices->links() }}
            </div>
            <!-- End Menu Pagination-->



        </div>
    </div>
    @include('scripts.delete')



    <script>
        function setAction(action) {
            document.getElementsByName('action')[0].value = action; // set nilai input hidden
        }




        const checkboxes = document.querySelectorAll('input[name="invoice[]"]');
        const btnDelete = document.getElementById('btn-delete');
        const btnConfirm = document.getElementById('btn-confirm');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                const checkedCheckboxes = document.querySelectorAll('input[name="invoice[]"]:checked');

                if (checkedCheckboxes.length === 0) {
                    btnDelete.disabled = true;
                } else {
                    btnDelete.disabled = false;
                }

                if (checkedCheckboxes.length === 0 || checkedCheckboxes.length > 1) {
                    btnConfirm.disabled = true;
                } else {
                    btnConfirm.disabled = false;
                }
            });
        });

        function setAction(action) {
            document.getElementsByName('action')[0].value = action;
        }


        //java script untuk filter is_paid


        // Otomatis submit form saat pemilihan opsi select
        document.getElementById('filter').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
</x-app-layout>
