@push('styles')
    <style>
        select {
            background-color: #fff;
        }

        select option::before {
            color: #fff;
        }
    </style>
@endpush
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
        <form method="POST" action="{{ route('admin.invoice.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card mt-5">
                <div class="card-body">


                    <div class="mb-3">
                        <label for="invoice_number" class="form-label fs-4 fw-bold">ID Invoice</label>
                        <input type="text" name="invoice_number" id="invoice_number"
                            class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number"
                            value="{{ old('invoice_number') }}" placeholder="004/INV-HC/III/2023">
                        @error('invoice_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label fs-4 fw-bold">Judul Invoice</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                            placeholder="Masukan Judul Invoice">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="invoice_date" class="form-label fs-4 fw-bold">Invoice Date</label>
                                <input type="date" name="invoice_date" id="invoice_date"
                                    class="form-control @error('invoice_date') is-invalid @enderror"
                                    value="{{ old('invoice_date') }}">
                                @error('invoice_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="due_date" class="form-label fs-4 fw-bold">Due Date</label>
                            <input type="date" name="due_date" id="date"
                                class="form-control @error('due_date') is-invalid
                                
                            @enderror"
                                value="{{ old('due_date') }}">

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
                            <input type="text" name="name_pic" id="name_pic"
                                value="{{ @$invoice->customer->name_pic }}" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                                <input type="email" name="email" id="email"
                                    value="{{ @$invoice->customer->email }}" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                        <div class="col">
                            <label for="no_handphone" class="form-label fs-4 fw-bold">No. Handphone</label>
                            <input type="text" name="no_handphone" id="no_handphone"
                                value="{{ @$invoice->customer->no_handphone }}" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><span class="fs-4 fw-bold">Alamat</span><i>(Nama
                                Jalan,Gedung,RT/RW,Kecamatan,Kabupate,Kode Pos dll)</i></label>
                        <textarea name="address" id="address" cols="30" rows="8" class="form-control" placeholder="Type here...">{{ @$invoice->customer->address }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="card-title">Masukan Tagihan</h3>
                    <div id="invoice-items-container">
                        <div id="invoice-item-0">
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="description" class="form-label fs-4 fw-bold">Keterangan</label>
                                    <input type="text" name="invoiceItems[0][description]"  class="form-control"
                                        placeholder="Masukan Keterangan Tagihan" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="stock" class="form-label fs-4 fw-bold">Kuantitas</label>
                                    <input type="number" name="invoiceItems[0][stock]"  id="stock" class="form-control"
                                    placeholder="Type here..." required>
                                </div>
                                <div class="col-md-2">
                                    <label for="unit" class="form-label fs-4 fw-bold">Pilih Unit</label>
                                    <select class="form-select fs-5 fw-bold @error('unit') is-invalid @enderror"
                                        name="invoiceItems[0][unit]" style="background: #6e11f4; color: white;" required>
                                        <option class="bg-white text-black" value="">Unit</option>
                                        <option class="bg-white text-black" value="pcs"
                                            @if (old('unit', @$invoice->unit) == 'pcs') selected @endif>
                                            PCS</option>
                                        <option class="bg-white text-black" value="jam"
                                            @if (old('unit', @$invoice->unit) == 'jam') selected @endif>
                                            Jam</option>
                                        <option class="bg-white text-black" value="meter"
                                            @if (old('unit', @$invoice->unit) == 'meter') selected @endif>
                                            Meter</option>
                                        <option class="bg-white text-black" value="ls"
                                            @if (old('unit', @$invoice->unit) == 'ls') selected @endif>
                                            LS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="images" class="form-label fs-4 fw-bold">File Tambahan</label>
                                    <input type="file" name="invoiceItems[0][images][]" class="form-control"
                                        multiple >
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label fs-4 fw-bold">Harga Satuan</label>
                                    <input type="number" name="invoiceItems[0][price]" id="price" class="form-control"
                                        placeholder="Rp" required>
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="nominal" class="form-label fs-4 fw-bold">Nominal</label>
                                <input type="number" name="invoiceItems[0][nominal]" id="nominal" class="form-control"
                                    placeholder="Rp" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-5">
                        <button type="button" class="btn fw-bold" onclick="addInvoiceItem()"
                            style="background: #6e11f4; color: #ffffff">
                            <i class="bi bi-plus fs-4 fw-bold"></i> Tambah Invoice Item</button>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.invoice.index') }}" class="btn"
                        style="border-color:#6e11f4
            ">Batal</a>
                    <button type="submit" class="btn ms-3"
                        style="background: #6e11f4; border-color: #fff; color:#fff;">Selesai</button>
                </div>
            </div>
        </form>

    </div>


    @include('scripts.addInvoiceItem')
</x-app-layout>
