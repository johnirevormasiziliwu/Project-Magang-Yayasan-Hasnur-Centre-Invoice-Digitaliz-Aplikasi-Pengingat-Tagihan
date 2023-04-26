<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customer.index', [
            "customers" => Customer::latest()->filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.customer.store');
        return view('admin.customer.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_agency' => 'required',
            'name_unit'  => 'required',
            'name_pic'  => 'required',
            'no_handphone' => ['required', 'regex:/^08[0-9]{8,10}$/', 'unique:customers,no_handphone'],
            'email' => ['required', 'string', 'email:dns', 'unique:customers,email'],
            'password' => ['required', 'min:8', 'max:255', 'confirmed', 'unique:customers,password'],
            'address' => 'required',
        ]);

        // Mendapatkan user yang sedang login
        //$user = Auth::user();

        $user = User::create([
            'name' => $request->name_agency,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Menambahkan user_id ke dalam data yang akan disimpan
        $validate['user_id'] = $user->id;
        Customer::create($validate);

        toast('Successfully Data User Di Tambahkan', 'success');
        return redirect()->route('admin.customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        $url = route('admin.customer.update', $customer);
        return view('admin.customer.form', compact('url', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_agency' => 'required',
            'name_unit'  => 'required',
            'name_pic'  => 'required',
            'no_handphone' => ['required', 'regex:/^08[0-9]{8,10}$/', Rule::unique('customers')->ignore($id)],
            'email' => ['required', 'email:dns', 'string', Rule::unique('customers')->ignore($id)],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
            'address' => 'required',
        ]);

        $customer = Customer::findOrFail($id);

        $user = User::where('id', $customer->user_id)->first();
        $userUpdate = [
            'name' => $request->name_agency,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user->update($userUpdate);
        $customer->update($validate);

        toast('Successfully Data User Di Ubah', 'success');
        return redirect()->route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */



    public function deleteCustomer(Request $request)
    {
        $customer = $request->input('customer');
        Customer::whereIn($customer->id, 'id')->delete();
        alert()->success('successfully', 'Data Customer Invoice Berhasil Di Hapus');
        return redirect()->back();
    }
}
