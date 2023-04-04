@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        
        <a href="{{route('add-user')}}"><button type="button" class="btn btn-sm btn-outline-secondary">
        <span data-feather="calendar" class="align-text-bottom"></span>
        Buat User
        </button></a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-sm btn-outline-secondary float-end">
            <span data-feather="calendar" class="align-text-bottom"></span>
        Delete
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
                    <th scope="col">Nama Instansi</th>
                    <th scope="col">Nama Unit</th>
                    <th scope="col">PIC</th>
                    <th scope="col">No. Handphone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Profile</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,002</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,003</td>
                    <td>data</td>
                    <td>rich</td>
                    <td>dashboard</td>
                    <td>tabular</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,003</td>
                    <td>information</td>
                    <td>placeholder</td>
                    <td>illustrative</td>
                    <td>data</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,004</td>
                    <td>text</td>
                    <td>random</td>
                    <td>layout</td>
                    <td>dashboard</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,005</td>
                    <td>dashboard</td>
                    <td>irrelevant</td>
                    <td>text</td>
                    <td>placeholder</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td>1,006</td>
                    <td>dashboard</td>
                    <td>illustrative</td>
                    <td>rich</td>
                    <td>data</td>
                    <td>text</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection