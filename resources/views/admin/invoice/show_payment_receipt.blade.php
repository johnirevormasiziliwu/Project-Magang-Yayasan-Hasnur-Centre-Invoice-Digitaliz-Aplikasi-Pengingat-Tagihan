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

                            <span class="d-block fs-3">Konfirmasi Pembayaran Invoice</span>
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

        @foreach ($invoices as $invoice)
            <div class="card mt-5">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold fs-4">ID Invoice</label>
                        <input type="text" disabled class="form-control" value="{{ @$invoice->invoice_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold fs-4">Judul Invoice</label>
                        <input type="text" disabled class="form-control" value="{{ @$invoice->title }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">A.N/Atas Nama PIC</label>
                                <input type="text" disabled class="form-control"
                                    value="{{ @$invoice->customer->name_pic }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">Name Unit</label>
                                <input type="text" disabled class="form-control"
                                    value="{{ @$invoice->customer->name_unit }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">Alamat E-mail</label>
                                <input type="text" disabled class="form-control"
                                    value="{{ @$invoice->customer->email }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">No Handphone</label>
                                <input type="text" disabled class="form-control"
                                    value="{{ @$invoice->customer->no_handphone }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">Tanggal Pembayaran</label>
                                <input type="text" class="form-control" disabled value="{{ @$invoice->payment_time }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label fw-bold fs-4">Nominal</label>
                                <input type="text" disabled class="form-control"
                                    value="{{ \App\Helper\Util::rupiah($invoice->nominal) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <div class="d-flex justify-content-star ">
                        @if ($invoice->is_paid == false && $invoice->payment_receipt == null)
                            <button disabled type="button" class="btn btn-primary d-inline-block me-5"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Lihat Bukti Pembayaran
                            </button>
                        @else
                            <button type="button" class="btn btn-primary d-inline-block me-5" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Lihat Bukti Pembayaran
                            </button>
                        @endif
                        <form action="{{ route('admin.confirm_payment', $invoice) }}" method="POST">
                            @csrf
                            @if ($invoice->is_paid == true)
                                <button class="btn btn-success disabled d-inline-block" aria-disabled="true"
                                    tabindex="-1">
                                    <i class="bi bi-check-circle"></i> Success Konfirmasi
                                </button>
                            @elseif($invoice->is_paid == false && $invoice->payment_receipt == null)
                                <button disabled type="submit" class="btn confirm-btn d-inline-block confirm-btn"
                                    style="background: #6e11f4; color:#fff">
                                    Konfirmasi Pembayaran
                                </button>
                            @else
                                <button type="submit" class="btn confirm-btn d-inline-block confirm-btn"
                                    style="background: #6e11f4; color:#fff">
                                    Konfirmasi Pembayaran
                                </button>
                            @endif
                        </form>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Bukti Pembayaran -
                                                {{ @$invoice->customer->name_pic }}
                                            </h5>
                                            <img src="{{ url('storage/', @$invoice->payment_receipt) }}"
                                                class="img-fluid" alt="Bukti Pembayaran" style="widht:300px;">
                                            <div class="align-items-center d-flex justify-content-between">
                                                <a href="{{ route('admin.download-payment-receipt', $invoice) }}" class="btn btn-primary">Download Payment Receipt</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    @include('scripts.confirm')
    @include('scripts.upload')
</x-app-layout>
