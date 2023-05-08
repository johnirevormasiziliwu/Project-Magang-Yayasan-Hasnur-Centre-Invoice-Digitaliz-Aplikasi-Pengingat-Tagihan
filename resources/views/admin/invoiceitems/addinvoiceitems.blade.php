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
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="#" class="form-label fs-4 fw-bold">ID Invoice</label>
                    <input type="text" class="form-control fs-4 fw-bold" value="{{ $invoice->invoice_number }}">
                </div>
                <div class="mb-3">
                    <label for="#" class="form-label fs-4 fw-bold">Judul Invoice</label>
                    <input type="text" class="form-control fs-4 fw-bold" value="{{ $invoice->title }}">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="#" class="form-label fs-4 fw-bold">Tanggal Invoice</label>
                            <input type="#" class="form-control fs-4 fw-bold"
                                value="{{ $invoice->invoice_date }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="#" class="form-label fs-4 fw-bold">Tanggal Jatuh Tempo</label>
                            <input type="text" class="form-control fs-4 fw-bold" value="{{ $invoice->due_date }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="#" class="form-label fs-4 fw-bold">Tujuan</label>
                        <input type="text" class="form-control fs-4 fw-bold"
                            value="{{ $invoice->customer->name_unit }}">
                    </div>
                    <div class="col">
                        <label for="#" class="form-label fs-4 fw-bold">Nama PIC</label>
                        <input type="text" class="form-control fs-4 fw-bold"
                            value="{{ $invoice->customer->name_pic }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="#" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                        <input type="text" class="form-control fs-4 fw-bold" value="{{ $invoice->customer->email }}">
                    </div>
                    <div class="col">
                        <label for="#" class="form-label fs-4 fw-bold">No Handphone</label>
                        <input type="text" class="form-control fs-4 fw-bold"
                            value="{{ $invoice->customer->no_handphone }}">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="address" class="form-label"><span class="fs-4 fw-bold">Alamat</span><i>(Nama
                            Jalan,Gedung,RT/RW,Kecamatan,Kabupate,Kode Pos dll)</i></label>
                    <textarea name="#" id="#" cols="30" rows="8" class="form-control">{{ $invoice->customer->address }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <h3>Masukkan Tagihan</h3>
                <form action="{{ route('admin.store-invoice-items') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="description" class="form-label fs-4 fw-bold">Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Masukan keterangan tagihan">
                        </div>
                        <div class="col-md-4">

                            <label for="stock" class="form-label fs-4 fw-bold">Kuantitas</label>
                            <input type="number" name="stock" id="stock"
                                value="{{ old('stock', @$invoice->stock) }}"
                                class="form-control @error('stock') is-invalid @enderror"
                                placeholder="inputkan jumlah">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-md-2 mt-5">

                            <!-- Select -->

                            <select class="form-select fs-5 fw-bold @error('unit') is-invalid @enderror"
                                name="unit">
                                <option value="" style="background: #6e11f4">Unit</option>
                                <option value="pcs" @if (old('unit', @$invoice->unit) == 'pcs') selected @endif>
                                    PCS</option>
                                <option value="jam" @if (old('unit', @$invoice->unit) == 'jam') selected @endif>
                                    Jam</option>
                                <option value="meter" @if (old('unit', @$invoice->unit) == 'meter') selected @endif>
                                    Meter</option>
                                <option value="ls" @if (old('unit', @$invoice->unit) == 'ls') selected @endif>
                                    LS</option>
                            </select>
                            <!-- End Select -->
                            @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="file" class="form-label fs-4 fw-bold">File Tambahan</label>
                                <input type="file" name="file" id="file"
                                    class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">

                            <label for="price" class="form-label fs-4 fw-bold">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">Rp</span>
                                <input type="number" \App\Helper\Util::rupiah() name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', @$invoice->price) }}" placeholder="inputkan harga satuan">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="nominal" class="form-label fs-4 fw-bold">Harga Total</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">Rp</span>
                                <input type="number" name="nominal" id="nominal" class="form-control"
                                    value="{{ old('nominal', @$invoice->nominal) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">

                        <button type="submit" class="btn fs-5 fw-bold mt-3 text-end"
                            style="background: #6e11f4; color:#fff">
                            <i class="bi bi-plus-circle-fill fs-5 fw-bold me-1"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        @php($total = 0)
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="mb-3">Review Invoice</h3>
                <div class="table-responsive">
                    <!-- Table -->
                    @php($total = 0)
                    <table class="table table-borderless table-thead-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="fw-bold">No</th>
                                <th scope="col" class="fw-bold">Keterangan</th>
                                <th scope="col" class="fw-bold">Kuantitas</th>
                                <th scope="col" class="fw-bold">Satuan</th>
                                <th scope="col" class="fw-bold">Nominal</th>
                                <th scope="col" class="fw-bold">Action</th>
                            </tr>
                        </thead>
                        @php($nomor = 1)
                        <tbody>
                            @foreach ($invoiceItems as $invoiceitem)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $invoiceitem->description }}</td>
                                    <td>{{ $invoiceitem->stock }}</td>
                                    <td>{{ \App\Helper\Util::rupiah($invoiceitem->price) }}</td>
                                    <td>{{ \App\Helper\Util::rupiah($invoiceitem->nominal) }}</td>
                                    <td class="d-flex">
                                        <button type="submit" class="btn btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="submit" class="btn btn-sm text-danger">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>

                                </tr>
                                @php($total += $invoiceitem->nominal)
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <th>Total:</th>
                                <td>{{ \App\Helper\Util::rupiah($total) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                   
                    
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

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
