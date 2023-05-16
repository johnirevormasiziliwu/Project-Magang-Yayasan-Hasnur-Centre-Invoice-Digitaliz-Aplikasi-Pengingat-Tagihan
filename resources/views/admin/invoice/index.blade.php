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

                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.invoice.create') }}"
                        style="background: #6e11f4">
                        <i class="bi bi-plus fs-4"></i> Buat Invoice
                    </a>

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

                    <form action="{{ route('admin.invoice.index') }}" method="get">
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


        <!-- button konfirmasi, hapus dan print -->
        <form action="{{ route('admin.invoice.deleteConfirm') }}" method="post">
            @csrf
            <!-- start konfirmasi, hapus dan print -->

            <div class="container mt-8">
                <div class="row">
                    <div class="text-end ">

                        <input type="hidden" name="action" value="">
                        <button type="submit" class="btn bg-white   me-3 border border-dark fs-5 "
                            onclick="setAction('confirm')" id="btn-confirm" disabled><i class="bi bi-file-earmark-text"
                                name="action" value="confirm"></i> Konfirmasi
                            Pembayaran</button>
                        <button class="btn bg-white border border-dark fs-5 me-3 ">
                            <i class="bi bi-printer"></i>
                        </button>
                        <button type="submit" class="btn bg-white delete-btn  border border-dark fs-5"
                            onclick="setAction('delete')" id="btn-delete" disabled><i class="bi bi-trash3"
                                name="action" value="delete"></i></button>

                    </div>
                </div>
            </div>
            <!-- end konfirmasi, hapus dan print -->

            <div class="card mt-5">
                <div class="card-body ">
                    <!-- Table -->
                    <div class="table-responsive">

                        <table class="table table-borderless table-thead-bordered ">
                            <thead style="background: #F7F1FF">
                                <tr class="rounded-pill">

                                    <th scope="col" class="fw-bold"><input type="checkbox" name="#"
                                            id="#"></th>

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

                                        <th><input type="checkbox" name="invoice[]" value="{{ $invoice->id }}">
                                        </th>

                                        <td>

                                            <a href="{{ route('admin.invoice.show', $invoice) }}">
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
                                            <a class="text-dark ms-4 fs-5"
                                                href="{{ route('admin.invoice.edit', $invoice->id) }}"
                                                style="margin-right: 20px;">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a class="rounded bg-info" href="{{ route('admin.invoiceitems.show', ['invoice' => $invoice->id, 'invoiceItem' => $invoice->invoiceItems->first()->id]) }}"
                                            style="  color: #fff; font-size: 10px; font-weight: 700; font-style: normal; line-height: 150%;  display: flex; flex-direction: row; justify-content:center;padding:4px;gap:10px ">Detail Tagihan</a>
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
        </form>

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
