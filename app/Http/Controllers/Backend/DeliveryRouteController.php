<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkpoint;
use App\Models\DeliveryRoute;

class DeliveryRouteController extends Controller
{
    public function index()
    {
        $data['routes'] = DeliveryRoute::all();
        $data['checkPoints'] = Checkpoint::all();
        return view('backend.deliveryroute.index', $data);
    }

    public function create()
    {
        $data['checkPoints'] = Checkpoint::all();

        return view('backend.deliveryroute.createOrUpdate', $data);
    }

    public function checkPointUi($id)
    {
        $data['checkPoints'] = Checkpoint::all();
        $data['id'] = $id;
        return view('backend.deliveryroute.select-checkPoint', $data);
    }

    public function store(Request $request)
    {
      
        $checkPoints = json_decode($request->get('checkPoints'), true);
        $cArr = [];
        foreach ($checkPoints as $item) {
            $value = $item['value'];
            $cArr[] = intval($value);

        }

        DeliveryRoute::create([
            'name' => $request->get('name'),
            'checkpoint_id' => ($cArr)
        ]);

        return redirect('/delivery-route');
    }

    public function edit($id)
    {
        $data['route'] = DeliveryRoute::find($id);
        $data['checkPoints'] = Checkpoint::all();
        return view('backend.deliveryroute.createOrUpdate', $data);

    }

    public function update(Request $request, $id)
    {
        $route = DeliveryRoute::find($id);
        $checkPoints = json_decode($request->get('checkPoints'), true);
        $cArr = [];
        foreach ($checkPoints as $item) {
            $value = $item['value'];
            $cArr[] = intval($value);

        }
        $route->checkpoint_id = $cArr;
        $route->save();
        return redirect('/delivery-route');

    }

    public function delete($id)
    {
        $checkPoint = DeliveryRoute::find($id);

        $checkPoint->delete();


        return redirect('/checkpoint')->with('status', 'Check Point Delete Success');
    }
}
