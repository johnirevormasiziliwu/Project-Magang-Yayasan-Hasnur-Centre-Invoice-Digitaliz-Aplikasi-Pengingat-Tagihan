<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customer.index', [
            "customers" => Customer::where('status', '!=', '2')->paginate(5)
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
        $validatedData = $request->validate([
            'name_agency' => 'required',
            'name_unit'  => 'required',
            'name_pic'  => 'required',
            'no_handphone' => ['required', 'regex:/^08[0-9]{8,10}$/', 'unique:customers'],
            'email' => ['required', 'string', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255', 'confirmed'],
            'address' => 'required',
        ]);
        try {
            DB::beginTransaction();


            $user = User::create([
                'name' =>  $validatedData['name_pic'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole('user');


            $customer = new Customer($validatedData);
            $customer->user_id = $user->id; // menghubungkan antara Customer dan User
            $customer->save();

            DB::commit();

            toast('Successfully Data User Di Tambahkan', 'success');
            return redirect()->route('admin.customer.index');
        } catch (\Exception $e) {
            DB::rollBack();

            throw ValidationException::withMessages([
                'failed' => 'Failed to add customer and user data.',
            ]);
        }

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



    public function destroy(Request $request)
    {
        $customerIds = $request->input('customer');
        $selectCustomers = Customer::whereIn('id', $customerIds)->get();
        $action = $request->input('action');

        if ($action == 'delete') {
            if (!empty($customerIds)) {
                foreach ($customerIds as $id) {
                    $customer = Customer::find($id);
                    if ($customer) {
                        $customer->delete();
                    }
                }

                alert()->success('successfully', 'Data invoice dihapus');
                return redirect()->back();
            }
        }
    }

    public function multiDelete(Request $request){

        $id = $request->customer;
        foreach ($id as $user) 
        {
            $customer = Customer::where('id', $user)->first();
            $customer->update(['status'=>'2']);
        }
        return redirect()->back();
    }
}
