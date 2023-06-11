<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page mb-5">
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

                            <span class="d-block fs-3">Akses menu dan informasi penting lainya di sini</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.invoice.index') }}"
                        style="background: #EFEFEF">
                        <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        @php($total = 0)
        <div class="card mt-5">

            <div class="card-body">
                <div class="mb-5">
                    <h5>Invoice ID : {{ $invoice->invoice_number }}</h5>
                    <h5>Judul Invoice : {{ $invoice->title }}</h5>
                    <h5>Name Unit : {{ $invoice->customer->name_unit }}</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless table-thead-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">No</th>
                                <th scope="col" class="fw-bold  text-black  tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">Keterangan</th>
                                <th scope="col" class="fw-bold  text-black  text-center tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">Kuantitas</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">Satuan</th>
                                <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">Nominal</th>
                                @if ($invoice->is_paid == false && $invoice->payment_receipt == false)
                                    <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap" style="max-width: 150px;">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php($nomor = 1)
                            @php($total = 0)
                            @foreach ($invoiceitems as $invoiceitem)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td class="text-nowrap">{{ $invoiceitem->description }}</td>
                                    <td class="text-nowrap text-center">{{ $invoiceitem->stock }}</td>
                                    <td class="text-nowrap" style="max-width: 150px;">{{ \App\Helper\Util::rupiah($invoiceitem->price) }}</td>
                                    <td class="text-nowrap" style="max-width: 150px;">{{ \App\Helper\Util::rupiah($invoiceitem->nominal) }}</td>
                                    @if ($invoice->is_paid == false && $invoice->payment_receipt == false)
                                        <td class="text-nowrap">
                                            <a
                                                href="{{ route('admin.invoiceitems.edit', ['invoice' => $invoice->id, 'invoiceitem' => $invoiceitem->id]) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.invoiceitems.destroy', ['invoice' => $invoice->id, 'invoiceitem' => $invoiceitem->id]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn delete-btn">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @php($total += $invoiceitem->nominal)
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <th style="font-size: 1rem; font-weight: 900">Total:</th>
                                <td class="text-nowrap" style=" max-width: 150px; font-size: 1rem; font-weight: 900">{{ \App\Helper\Util::rupiah($total) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>

    </div>
    @include('scripts.delete')
    <script>
        // script mengihitung price dan stock secara otomatis
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        const totalPriceInput = document.getElementById('nominal');

        function calculateTotalPrice() {
            const price = parseInt(priceInput.value) || 0;
            const stock = parseInt(stockInput.value) || 0;
            const totalPrice = price * stock;
            totalPriceInput.value = totalPrice;
        }

        priceInput.addEventListener('input', calculateTotalPrice);
        stockInput.addEventListener('input', calculateTotalPrice);
        // end script mengihitung price dan stock secara otomatis
    </script>
</x-app-layout>
