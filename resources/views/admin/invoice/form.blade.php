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
                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.invoice.index') }}"
                        style="background: #EFEFEF">
                        <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Stars Form-->
        <div class="card mt-5">
            <div class="card-body">
                <form action="{{ $url }}" method="post">
                    @csrf
                    @if (@$invoice)
                        @method('put');
                    @endif

                    <div class="mb-3">
                        <label for="invoice_id" class="form-label fs-4 fw-bold">ID Invoice</label>
                        <input type="text" name="invoice_id" id="invoice_id"
                            class="form-control @error('invoice_id') is-invalid @enderror"
                            placeholder="inputkan ID invoice" value="{{ old('invoice_id', @$invoice->invoice_id) }}"
                            {{ @$invoice ? 'disabled' : '' }}>
                        @error('invoice_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="title" class="form-label fs-4 fw-bold">Judul Invoice</label>
                        <input type="text" name="title" id="title"
                            class="form-control  @error('title') is-invalid @enderror"
                            placeholder="Masukan Judul Invoice" value="{{ old('title', @$invoice->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="invoice_date" class="form-label fs-4 fw-bold">Tanggal Invoice</label>
                                <input type="date" name="invoice_date" id="invoice_date"
                                    class="form-control @error('invoice_date') is-invalid @enderror "
                                    value="{{ old('invoice_date', @$invoice->invoice_date) }}">
                            </div>
                            @error('invoice_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="due_date" class="form-label fs-4 fw-bold">Tanggal Jatuh Tempo</label>
                                <input type="date" name="due_date" id="due_date"
                                    class="form-control @error('due_date') is-invalid @enderror"
                                    value="{{ old('due_date', @$invoice->due_date) }}">
                            </div>
                            @error('due_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="customer_id" class="form-label fs-4 fw-bold">Tujuan</label>

                            <!-- Select -->

                            <select onchange="getCustomer(this.value)" name="customer_id"
                                class="form-select fs-5 fw-bold @error('customer_id', @$invoice->customer->name_unit) is-invalid @enderror">
                                <option value="">Pilih User</option>
                                @forelse ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id || @$invoice->customer->id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name_unit }}
                                    </option>
                                @empty
                                    <option disabled class="text-center">No Data</option>
                                @endforelse
                            </select>


                            <!-- End Select -->
                            @error('customer_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="name_pic" class="form-label fs-4 fw-bold">Name PIC</label>
                            <input type="text" name="name_pic" id="name_pic" value="{{ @$invoice->customer->name_pic }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                                <input type="email" name="email" id="email" value="{{ @$invoice->customer->email }}" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <label for="no_handphone" class="form-label fs-4 fw-bold">No. Handphone</label>
                            <input type="text" name="no_handphone" id="no_handphone" value="{{ @$invoice->customer->no_handphone }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><span class="fs-4 fw-bold">Alamat</span><i>(Nama
                                Jalan,Gedung,RT/RW,Kecamatan,Kabupate,Kode Pos dll)</i></label>
                        <textarea name="address" id="address" cols="30" rows="8" class="form-control">{{ @$invoice->customer->address }}</textarea>
                    </div>


                    <div class="row mt-3">
                        <div class="col">
                            <label for="images" class="form-label fs-4 fw-bold">File Tambahan</label>

                            <div id="basicExampleDropzone"
                                class="js-dropzone row dz-dropzone dz-dropzone-card bg-white">
                                <div class="dz-message ">
                                    <span class="svg-icon svg-icon-lg mb-3"></span>
                                    <i class="bi bi-cloud-arrow-up" style="font-size:3rem"></i>
                                    <h5>Drag and drop your file here</h5>

                                    <p class="mb-2">or</p>

                                    <span class="btn btn-white btn-sm">Browse files</span>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="price" class="form-label fs-4 fw-bold">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Rp</span>
                                    <input type="number" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', @$invoice->price) }}"
                                        placeholder="inputkan harga satuan">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="stock" class="form-label fs-4 fw-bold">Jumlah</label>
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
                                <div class="col-4 mt-5">
                                    <!-- Select -->

                                    <select class="form-select fs-5 fw-bold @error('unit') is-invalid @enderror"
                                        name="unit">
                                        <option value="">Pilih Unit</option>
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
                            <div class="col mt-5">
                                <label for="nominal" class="form-label fs-4 fw-bold">Harga Total</label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Rp</span>
                                    <input type="number" name="nominal" id="nominal" class="form-control"
                                        value="{{ old('nominal', @$invoice->nominal) }}" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-5 float-end">
                        <div class="col">
                            <a href="{{ route('admin.invoice.index') }}" class="btn"
                                style="border-color: #6e11f4; color: 
                            ">
                                Batal
                            </a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn"
                                style="background: #6e11f4; color:#fff">Selesai</button>
                        </div>
                    </div>
                </form>
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
            

            



            // mengambil data user secara otomatis ketika di select
            
            const selectElement = document.getElementById('my-select');
            const relatedDataContainer = document.getElementById('related-data-container');
            
            
            function getCustomer(id) {
                const addressInput = document.getElementById('address');
                const emailInput = document.getElementById('email');
                const no_handphoneInput = document.getElementById('no_handphone');
                const name_picInput = document.getElementById('name_pic');
                
                
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.getCustomer') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        console.log('success');
                        addressInput.value = response.address
                        emailInput.value = response.email
                        no_handphoneInput.value = response.no_handphone
                        name_picInput.value = response.name_pic
                    }
                })
            }
            // end mengambil data user secara otomatis ketika di select
        </script>


</x-app-layout>
