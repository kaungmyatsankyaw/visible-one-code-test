<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkpoint;

class CheckPointController extends Controller
{
    public function index()
    {
        $data['checkPoints'] = CheckPoint::all();
        return view('backend.checkpoint.index', $data);
    }

    public function create()
    {
        return view('backend.checkpoint.createOrUpdate');
    }

    public function store(Request $request)
    {
        Checkpoint::create($request->all());
        return redirect('/checkpoint')->with('status', 'Check Point Create Success');
    }

    public function edit($id)
    {
        $data['checkPoint'] = Checkpoint::find($id);
        return view('backend.checkpoint.createOrUpdate', $data);
    }

    public function update($id, Request $request)
    {
        $checkPoint = Checkpoint::find($id);

        $input = $request->all();

        $checkPoint->update($input);
        return redirect('/checkpoint')->with('status', 'Check Point Update Success');

    }

    public function delete($id)
    {
        $checkPoint = Checkpoint::find($id);

        $checkPoint->delete();


        return redirect('/checkpoint')->with('status', 'Check Point Delete Success');
    }

}
