<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    public function index()
    {
        $data['drivers'] = User::where('user_type', 2)->get();
        return view('backend.driver.index', $data);
    }

    public function create()
    {
        $data['url'] = url('/add-driver');
        $data['type'] = 'driver';
        $data['show_password'] = true;
        $data['page_title'] = 'Add New Driver';
        return view('backend.base.c-d-create', $data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_type'] = 2;
        User::create($data);
        return redirect('/driver')->with('status', 'Add New Driver Success');
    }

    public function edit($id)
    {
        $data['people'] = User::find($id);
        $data['url'] = url('/edit-driver/' . $id);
        $data['show_password'] = false;
        $data['type'] = 'driver';
        $data['page_title'] = 'Add New Driver';
        return view('backend.base.c-d-create', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect('/driver')->with('status', 'Edit Driver Success');

    }

    public function delete($id)
    {
        // Fetch the user by ID
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();

            return redirect('/driver')->with('status', 'Edit Driver Success');
        }


    }
}
