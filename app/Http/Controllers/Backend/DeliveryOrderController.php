<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\DeliveryRoute;
use App\Models\User;
use App\Models\Car;
use App\Models\GoodRecievedNoteItem;
use App\Models\GoodRecievedNote;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;


class DeliveryOrderController extends Controller
{
    public function index()
    {
        $data['orders'] = DeliveryOrder::all();
        return view('backend.deliveryorder.index', $data);
    }

    public function create()
    {
        $data['customers'] = Customer::all();
        $data['routes'] = DeliveryRoute::all();
        $data['drivers'] = User::where('user_type', 2)->get();
        $data['cars'] = Car::all();
        $data['branches'] = [];

        return view('backend.deliveryorder.create', $data);

    }

    function searchItem(Request $request)
    {
        $search = $request->get('search');

        // $notes = GoodRecievedNote::where('bl_number', 'like', '%' . $search . '%')->get();

        // if(count($notes) > 0) {

        // }

        $data['items'] = GoodRecievedNoteItem::where('container_number', 'like', '%' . $search . '%')
            ->orWhere('item_description', 'like', '%' . $search . '%')
            ->get();

        return view('backend.deliveryorder.item', $data);
    }

    public function addItems(Request $request)
    {
        $data = $request->get('data');
        $itemIds = collect($data)->pluck('item_id')->toArray();
        foreach ($itemIds as $key => $value) {
            $itemIds[$key] = intval($value);
        }

        $items = GoodRecievedNoteItem::whereIn('id', $itemIds)->get();

        foreach ($data as $key => $value) {
            foreach ($items as $item) {
                if ($item->id == $data[$key]['item_id']) {
                    $item['qty_out'] = $data[$key]['qtyOut'];
                    $item['qty_balance'] = $data[$key]['qtyBal'];
                    $item['remark'] = $data[$key]['remark'];
                }
            }
        }

        $data['items'] = $items;
        $data['add_item_list'] = true;
        $data['item_ids'] = $itemIds;
        return view('backend.deliveryorder.item', $data);


    }

    public function store(Request $request)
    {
        $order_id = null;
        if ($request->has('order_id')) {
            $order_id = $request->get('order_id');
        } else {
            $order = DeliveryOrder::create([
                'customer_id' => $request->get('customer'),
                'route_id' => $request->get('route'),
                'driver_id' => $request->get('driver'),
                'date' => date('Y-m-d', strtotime($request->get('date'))),
                'car_id' => $request->get('car')
            ]);
            $order_id = $order->id;
        }

        foreach ($request->get('items') as $item) {

            $gItem = GoodRecievedNoteItem::where('id', $item['item_id'])->first();
            $gItem->qty_balance = $item['qty_balance'];
            $gItem->qty_out = $gItem->qty_out + $item['qty_out'];
            $gItem->save();

            $item['delivery_order_id'] = $order_id;
            DeliveryOrderItem::create($item);
        }

    }

    public function show($id)
    {
        $data['order'] = DeliveryOrder::find($id);
        return view('backend.deliveryorder.show', $data);
    }

    public function deleteDoItem($id)
    {
        $doItem = DeliveryOrderItem::find($id);

        $item = GoodRecievedNoteItem::where('id', $doItem->item_id)->get()[0];

        $item->qty_out -= $doItem->qty_out;
        $item->qty_balance += $doItem->qty_out;
        $item->save();
        $doItem->delete();
        return redirect()->back()->with('status', 'Delete Successfully');
    }

    public function addItemsUi($id)
    {
        $data['order'] = DeliveryOrder::find($id);
        return view('backend.deliveryorder.addItems', $data);

    }

    public function editOrderUi($id)
    {
        $data['order'] = DeliveryOrder::find($id);
        $data['customers'] = Customer::all();
        $data['routes'] = DeliveryRoute::all();
        $data['drivers'] = User::where('user_type', 2)->get();
        $data['cars'] = Car::all();
        return view('backend.deliveryorder.editOrder', $data);
    }

    public function editOrder(Request $request, $id)
    {
        $order = DeliveryOrder::find($id);
        $order->update($request->except('date'));
        $order->date = date('Y-m-d', strtotime($request->get('date')));
        $order->save();
        return redirect('/delivery-order')->with('status', 'Update Order Successfully');

    }

    public function delete($id)
    {
        $order = DeliveryOrder::find($id);
        $groupedItems = $order->items->groupBy('item_id');

        $itemsOut = $groupedItems->map(function ($group) {
            return $group->sum('qty_out');
        })->toArray();

        foreach ($itemsOut as $key => $itemOut) {

            $item = GoodRecievedNoteItem::find($key);
            $item->qty_balance += intval($itemOut);
            $item->qty_out  -= intval($itemOut);
            $item->save();
        }


        $order->delete();
        foreach ($order->items as $item) {
            $item->delete();
        }
        return redirect('/delivery-order')->with('status', 'Delete Order Successfully');

    }
}
