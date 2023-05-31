<x-app-layout>
    <div class="content container-fluid ">
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
                    <a class="btn btn-sm text-white fw-bold" href="{{ url()->previous() }}" style="background: #EFEFEF">
                        <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mt-5">
            <form
                action="{{ route('admin.invoiceitems.update', ['invoice' => $invoice->id, 'invoiceitem' => $invoiceitem->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="description" class="form-label fs-4 fw-bold">Keterangan</label>
                        <input type="text" name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ old('description', $invoiceitem->description) }}">
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="images" class="form-label fs-4 fw-bold">File Tambahan</label>
                                <input type="file" class="form-control" name="images">
                            </div>

                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="unit" class="form-label fs-4 fw-bold">Pilih Unit</label>
                                <select class="form-select unit fs-5 fw-bold @error('unit') is-invalid @enderror"
                                    name="unit">
                                    <option value="" style="background: #6e11f4">Unit</option>
                                    <option value="pcs" @if (old('unit', $invoiceitem->unit) == 'pcs') selected @endif>
                                        PCS</option>
                                    <option value="jam" @if (old('unit', $invoiceitem->unit) == 'jam') selected @endif>
                                        Jam</option>
                                    <option value="meter" @if (old('unit', $invoiceitem->unit) == 'meter') selected @endif>
                                        Meter</option>
                                    <option value="ls" @if (old('unit', $invoiceitem->unit) == 'ls') selected @endif>
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="stock" class="form-label fs-4 fw-bold">Kuantitas</label>
                                <input type="number" name="stock" id="stock"
                                    value="{{ old('stock', $invoiceitem->stock) }}"
                                    class="form-control @error('stock') is-invalid @enderror">
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="price" class="form-label fs-4 fw-bold">Harga Satuan</label>
                            <input type="number" name="price" id="price"
                                value="{{ old('price', $invoiceitem->price) }}" class="form-control">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="nominal" class="form-label fs-4 fw-bold">Total Nominal</label>
                            <input type="number" name="nominal" id="nominal"
                                value="{{ old('nominal', $invoiceitem->nominal) }}"
                                class="form-control @error('nominal') is-invalid @enderror" readonly>
                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn me-5" style="border-color:#6e11f4; color: black;">
                        Batal
                    </a>
                    <button type="submit" class="btn" style="background: #6e11f4; color:#fff;">Selesai</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        const stockInput = document.getElementById('stock');
        const priceInput = document.getElementById('price');
        const nominalInput = document.getElementById('nominal');

        function updateNominal() {
            const stock = parseInt(stockInput.value);
            const price = parseInt(priceInput.value);
            const nominal = stock * price;
            nominalInput.value = nominal;
        }

        stockInput.addEventListener('input', updateNominal);
        priceInput.addEventListener('input', updateNominal);
    </script>

</x-app-layout>
