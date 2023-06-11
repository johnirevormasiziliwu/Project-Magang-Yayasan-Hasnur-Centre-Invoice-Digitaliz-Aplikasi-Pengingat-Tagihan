<x-app-layout>

    <div class="content container-fluid ">
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

                            <h1 class="text-hover-primary fw-bold  text-black">E-mail</h1>

                            <span class="d-block ">Akses Menu dan Informasi Penting Lainya Disini</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <a class="btn btn-sm text-white fw-bold" href="{{ route('admin.email.index') }}"
                        style="background: #EFEFEF">
                        <i class="bi bi-arrow-left text-black fs-5 fw-bold"></i>
                    </a>
                </div>

            </div>
        </div>
        <!-- End Page Header -->

        <div class="card mt-5">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fs-4 fw-bold">ID Invoice</label>
                    <input type="text" class="form-control" value="{{ $invoice->invoice_number }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fs-4 fw-bold">Judul Invoice</label>
                    <input type="text" class="form-control" value="{{ $invoice->title }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fs-4 fw-bold">Tanggal Invoice</label>
                            <input type="date" name="" class="form-control" id=""
                                value="{{ $invoice->invoice_date }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fs-4 fw-bold">Tanggal Jatuh Tempo</label>
                            <input type="date" name="" class="form-control" id=""
                                value="{{ $invoice->due_date }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label fs-4 fw-bold">Tujuan</label>
                        <!-- Select -->

                        <select name="customer_id"
                            class="form-select fs-5 fw-bold @error('customer_id', @$invoice->customer->name_unit) is-invalid @enderror">
                            <option value="">Pilih User</option>
                            @forelse ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id || @$invoice->customer->id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name_unit }}
                                </option>
                            @empty
                                <option class="text-center">No Data</option>
                            @endforelse
                        </select>

                        <!-- End Select -->
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label fs-4 fw-bold">Name PIC</label>
                        <input type="text" class="form-control" value="{{ $invoice->customer->name_pic }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fs-4 fw-bold">Alamat E-mail</label>
                            <input type="text" class="form-control" value="{{ $invoice->customer->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label fs-4 fw-bold">No Handphone</label>
                        <input type="text" class="form-control" value="{{ $invoice->customer->no_handphone }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="col-form-label d-md-inline-block text-truncate"
                        style="max-width: 100%;">
                        <span class="form-label fs-4 fs-md-3 fs-lg-4 fw-bold d-inline-block">Alamat</span>
                        <i class="d-inline-block"> (Nama Jalan, Gedung, RT/RW, Kecamatan, Kabupaten, Kode Pos
                            dll)</i>
                    </label>
                    <textarea name="address" id="address" cols="30" rows="8" class="form-control">{{ $invoice->customer->address }}</textarea>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="h3 mb-5">Review Invoice</div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-thead-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap"
                                            style="max-width: 150px;">No</th>
                                        <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap"
                                            style="max-width: 150px;">Keterangan</th>
                                        <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap"
                                            style="max-width: 150px;">Kuantitas</th>
                                        <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap"
                                            style="max-width: 150px;">Satuan</th>
                                        <th scope="col" class="fw-bold  text-black tex-nowrap fs-5 tex-nowrap"
                                            style="max-width: 150px;">Nominal</th>
                                        {{-- @if ($invoice->is_paid == false && $invoice->payment_receipt == false)
                                        <th scope="col" class="fw-bold">Action</th>
                                        @endif  --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($nomor = 1)
                                    @php($total = 0)
                                    @foreach ($invoiceItems as $invoiceitem)
                                        <tr>
                                            <td class="text-nowrap">{{ $nomor++ }}</td>
                                            <td class="text-nowrap">{{ $invoiceitem->description }}</td>
                                            <td class="text-nowrap">{{ $invoiceitem->stock }}</td>
                                            <td class="text-nowrap">
                                                {{ \App\Helper\Util::rupiah($invoiceitem->price) }}</td>
                                            <td class="text-nowrap">
                                                {{ \App\Helper\Util::rupiah($invoiceitem->nominal) }}</td>
                                        </tr>
                                        @php($total += $invoiceitem->nominal)
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th style="font-size: 1rem; font-weight: 900">Total:</th>
                                        <td class="text-nowrap" style="font-size: 1rem; font-weight: 900">
                                            {{ \App\Helper\Util::rupiah($total) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="mb-3 mt-5">
                    <label for="" class="form-label fs-4 fw-bold">Pesan</label>
                    <textarea name="" id="" cols="30" rows="20" class="form-control ">
Dear {{ $invoice->customer->name_unit }},

Saya berharap pesan ini menemukan Anda dalam keadaan sehat dan baik-baik saja. Saya ingin mengingatkan Anda bahwa faktur kami nomor {{ $invoice->invoice_id }} berjudul {{ $invoice->title }} dengan tanggal jatuh tempo pada tanggal {{ date('d F Y', strtotime($invoice->due_date)) }} masih belum dibayarkan.

Jumlah yang harus dibayarkan adalah {{ \App\Helper\Util::rupiah($total) }} seperti yang tertera pada faktur. Sesuai dengan persyaratan kontrak kami, pembayaran harus dibuat tepat waktu. Kami telah memberikan layanan kepada Anda dengan sepenuh hati dan kami berharap Anda juga dapat memenuhi kewajiban Anda dalam hal pembayaran. Kami sangat menghargai hubungan bisnis yang baik dengan Anda dan kami berharap dapat terus bekerja sama dengan Anda dalam jangka panjang.

Saya meminta Anda untuk segera membayar faktur ini dalam waktu 10 hari. Jika ada masalah dengan faktur atau informasi tambahan yang dibutuhkan, silakan hubungi kami segera.

Terima kasih atas perhatian Anda pada masalah ini. Saya berharap dapat menerima pembayaran dari Anda segera.

Hormat saya,


Yayasan Hasnur Center
                   </textarea>
                </div>

                <!-- button email dan whatshap -->
                <label for="" class="form-label fs-4 fw-bold">Kirim</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <a class="btn btn-white col" href="{{ route('admin.markInvoiceAsPaid', $invoice) }}">
                                <img src="{{ asset('images/icon/gmail.png') }}" alt="Gambar Tombol Email"
                                    style="width: 30px">
                                <b>{{ $invoice->customer->email }}</b>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <a onclick="whatsapp()" target="_blank" class="btn btn-white col ">
                                <img src="{{ asset('images/icon/whatsapp.png') }}" alt="Gambar Tombol No Handphone"
                                    style="width: 25px">
                                {{ $invoice->customer->no_handphone }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-footer float-end">
                    <a href="{{ route('admin.email.index') }}" class="btn text-white"
                        style="background: #6e11f4;">
                        Batal
                    </a>
                </div>

            </div>
        </div>
</x-app-layout>

<script type="text/javascript">
    function whatsapp() {
        var customerName = "{{ $invoice->customer->name_unit }}";
        var invoiceId = "{{ $invoice->invoice_number }}";
        var invoiceTitle = "{{ $invoice->title }}";
        var dueDate = "{{ date('d F Y', strtotime($invoice->due_date)) }}";
        var totalAmount = "{{ \App\Helper\Util::rupiah($total) }}";

        var message = "Dear *" + customerName + "* ,\n\n" +
            "Saya berharap pesan ini menemukan Anda dalam keadaan sehat dan baik-baik saja. Saya ingin mengingatkan Anda bahwa faktur kami nomor *" +
            invoiceId + "* berjudul *" + invoiceTitle + "* dengan tanggal jatuh tempo pada tanggal *" + dueDate +
            "* masih belum dibayarkan.\n\n" +
            "Jumlah yang harus dibayarkan adalah  *" + totalAmount +
            "* seperti yang tertera pada faktur. Sesuai dengan persyaratan kontrak kami, pembayaran harus dibuat tepat waktu. Kami telah memberikan layanan kepada Anda dengan sepenuh hati dan kami berharap Anda juga dapat memenuhi kewajiban Anda dalam hal pembayaran. Kami sangat menghargai hubungan bisnis yang baik dengan Anda dan kami berharap dapat terus bekerja sama dengan Anda dalam jangka panjang.\n\n" +
            "Saya meminta Anda untuk segera membayar faktur ini dalam waktu 10 hari. Jika ada masalah dengan faktur atau informasi tambahan yang dibutuhkan, silakan hubungi kami segera.\n\n" +
            "Terima kasih atas perhatian Anda pada masalah ini. Saya berharap dapat menerima pembayaran dari Anda segera.\n\n" +
            "Hormat saya,\n\n" +
            "Yayasan Hasnur Center";

        var encodedMessage = encodeURIComponent(message);
        var url = "https://wa.me/{{ $nmrwa }}?text=" + encodedMessage;
        window.open(url, "_blank");
    }
</script>
