<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data['customers'] = Customer::all();
        return view('backend.customer.index', $data);
    }

    public function create()
    {
        $data['url'] = url('/add-customer');
        $data['type'] = 'customer';
        $data['page_title'] = 'Add New Customer';
        return view('backend.base.c-d-create', $data);
    }

    public function store(Request $request)
    {

        Customer::create([
            'cus_id' => 'CUS' . str_pad(mt_rand(1, 1500), 5, '0', STR_PAD_LEFT),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip_code' => $request->get('zip_code'),
            'country' => $request->get('country'),
            'address' => $request->get('address')
        ]);

        return redirect('/customer')->with('status', 'Customer Add Success');
    }

    public function edit($id)
    {
        $data['url'] = url('/edit-customer/' . $id);
        $data['type'] = 'customer';
        $data['people'] = Customer::find($id);
        $data['page_title'] = 'Edit Customer';
        return view('backend.base.c-d-create', $data);
    }



    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $customer->update($request->all());

        return redirect('/customer')->with('status', 'Customer Edit Success');


    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/car-truck')->with('status', 'Car Delete successfully.');

    }

}
