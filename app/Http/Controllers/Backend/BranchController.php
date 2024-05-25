<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Branch;

class BranchController extends Controller
{
    protected $form_fields;

    public function __construct()
    {
        $this->form_fields =
            [

                [
                    'name' => 'name',
                    'type' => 'text',
                    'required' => true,
                    'label' => 'Name'
                ],
                [
                    'name' => 'city',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'City'
                ],
                [
                    'name' => 'state',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'State'
                ],
                [
                    'name' => 'country',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'Country'
                ],
                [
                    'name' => 'address',
                    'type' => 'textarea',
                    'required' => false,
                    'label' => 'Address'
                ]
            ];
    }

    public function index()
    {
        $data['branches'] = Branch::all();
        return view('backend.branch.index', $data);
    }


    public function create()
    {
        $data['fields'] = $this->form_fields;
        $data['page_title'] = 'Add New Branch';
        return view('backend.branch.createOrUpdate', $data);
    }


    public function store(Request $request)
    {
        Branch::create($request->all());
        return redirect('/branches')->with('status', 'Branch Create Success');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['branch'] = Branch::findOrFail($id);
        $data['fields'] = $this->form_fields;
        $data['page_title'] = 'Edit Branch';
        return view('backend.branch.createOrUpdate', $data);
    }


    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->update($request->all());

        return redirect('/branches')->with('status', 'Branch Update successfully.');
    }


    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect('/branches')->with('status', 'Branch Delete successfully.');
    }
}
