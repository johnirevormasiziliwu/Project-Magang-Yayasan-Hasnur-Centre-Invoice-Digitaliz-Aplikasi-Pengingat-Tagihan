<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoice');
    }

    public function add()
    {
        return view('admin.add-invoice');
    }
}
