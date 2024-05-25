<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Branch;

class BranchManagerController extends Controller
{

    public function index()
    {
        $data['managers'] = User::where('user_type', 3)->get();
        return view('backend.branch-manager.index', $data);
    }


    public function create()
    {
        $data['page_title'] = 'Add New Branch Manager';
        $data['branches'] = Branch::all();
        $data['show_password'] = true;
        return view('backend.branch-manager.createOrUpdate', $data);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_type'] = 3;
        User::create($data);
        return redirect('/branch-manager')->with('status', 'Add New Manager Success');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['page_title'] = 'Add New Branch Manager';
        $data['branches'] = Branch::all();
        $data['people'] = User::find($id);
        $data['show_password'] = false;
        return view('backend.branch-manager.createOrUpdate', $data);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect('/branch-manager')->with('status', 'Edit Manager Success');

    }


    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            // Delete the user
            $user->delete();

            return redirect('/branch-manager')->with('status', 'Delete Manager Success');

        }
    }
}
