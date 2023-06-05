<x-app-layout>
    @push('styles')
        <style>
            .card-body {
                position: relative;
            }

            #preview-image {
                width: 100%;
                height: auto;
            }
        </style>
    @endpush
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
                    <a class="btn btn-sm text-white fw-bold" href="{{ route('user.invoice.index') }}"
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
                    <label for="" class="form-label fw-bold fs-4">ID Invoice</label>
                    <input type="text" disabled class="form-control" value="{{ $invoice->invoice_number }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold fs-4">Judul Invoice</label>
                    <input type="text" disabled class="form-control" value="{{ $invoice->title }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold fs-4">A.N/Atas Nama PIC</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $invoice->customer->name_pic }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold fs-4">Name Unit</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $invoice->customer->name_unit }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold fs-4">Alamat E-mail</label>
                            <input type="text" disabled class="form-control" value="{{ $invoice->customer->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label fw-bold fs-4">No Handphone</label>
                            <input type="text" disabled class="form-control"
                                value="{{ $invoice->customer->no_handphone }}">
                        </div>
                    </div>
                </div>

                @php($totalInvoiceNominal = 0)
                @foreach ($invoice->invoiceItems as $invoiceItem)
                    @php($totalInvoiceNominal += $invoiceItem->nominal)
                @endforeach
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold fs-4">Nominal</label>
                        <input type="text" disabled class="form-control"
                            value="{{ \App\Helper\Util::rupiah($totalInvoiceNominal) }}">
                    </div>
                </div>

                @if ($invoice->is_paid == 0 && $invoice->payment_receipt == null)
                    <form action="{{ route('user.upload-payment-receipt', $invoice) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="payment_receipt" class="form-label"><span class="fs-4 fw-bold">Upload Bukti
                                        Pembayaran</span> (jpeg,jpg,pdf,png)</label>
                                <input type="file" name="payment_receipt" id="payment_receipt"
                                    class="form-control @error('payment_receipt') is-invalid @enderror">
                                @error('payment_receipt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label fs-4 fw-bold">Bukti Pembayaran</label>
                                <div class="mb-3">
                                    <img src="#" id="preview-image" style="display:none; width:400px;">
                                </div>
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="text-end">
                                    <a href="{{ route('user.invoice.index') }}" class="btn fs-5 me-5"
                                        style="border-color: #6e11f4; color: ">
                                        Kembali
                                    </a>

                                    <button type="submit" class="btn confirm-btn upload-btn"
                                        style="background: #6e11f4; color:#fff">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif


            </div>
        </div>
    </div>

    @include('scripts.upload')

    <script>
        // Mendeteksi perubahan pada input file dan menampilkan preview gambar
        document.getElementById("payment_receipt").addEventListener("change", function(event) {
            // Mendapatkan file yang dipilih
            const file = event.target.files[0];

            // Membuat FileReader object
            const reader = new FileReader();

            // Setelah file terbaca, tampilkan preview gambar
            reader.onload = function(e) {
                document.getElementById("preview-image").src = e.target.result;
                document.getElementById("preview-image").style.display = "block";
            }

            // Membaca file sebagai URL
            reader.readAsDataURL(file);
        });
    </script>
</x-app-layout>
