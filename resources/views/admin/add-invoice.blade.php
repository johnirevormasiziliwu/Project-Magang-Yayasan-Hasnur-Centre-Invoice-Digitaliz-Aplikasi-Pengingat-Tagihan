@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Invoice</h1>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-12">
                <label for="inputAddress" class="form-label">ID Invoice</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Judul</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Tanggal Invoice</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Tanggal Jatuh Tempo</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Tujuan</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nama PIC</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Alamat E-Mail</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">No. Handphone</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat (Nama Jalan, Gedung, RT/RW, Kecamatan, Kabupaten, Kode Pos dll.)</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">File Tambahan</label>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Rate Harga</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Kuantitas</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Harga Total</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-12">
                <div class="float-end">
                    <button type="submit" class="btn btn-outline-secondary  me-3">Batal</button>
                    <button type="submit" class="btn btn-primary ">Selesai</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection