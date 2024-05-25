<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\GoodRecievedNoteItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoicesController extends Controller
{
    public function index()
    {
        $data['invoices'] = Invoice::all();
        return view('backend.invoices.index', $data);
    }

    public function create()
    {
        $data['customers'] = Customer::all();
        return view('backend.invoices.create', $data);
    }

    public function edit($id)
    {
        $data['customers'] = Customer::all();
        $data['invoice'] = Invoice::find($id);
        return view('backend.invoices.edit', $data);
    }

    public function update(Request $request, $id)
    {
      
        $invoice = Invoice::find($id);
        $invoice->update([
            'customer_id' => $request->get('customer_id'),
            'invoice_number' => $request->get('invoice_number'),
            'date' => date('Y-m-d', strtotime($request->get('date'))),
            'due_date' => date('Y-m-d', strtotime($request->get('due_date'))),
            'reference' => $request->get('reference'),
            'project' => $request->get('project')
        ]);
        return redirect('/invoices')->with('status', 'Update Invoice Success');

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
                    $item['unit_price'] = $data[$key]['unitPrice'];
                    $item['qty'] = $data[$key]['qty'];

                }
            }
        }

        $data['items'] = $items;
        $data['add_item_list'] = true;
        $data['item_ids'] = $itemIds;
        return view('backend.invoices.item', $data);


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

        return view('backend.invoices.item', $data);
    }

    public function store(Request $request)
    {
        $invoice_id = null;
        if ($request->has('invoice_id')) {
            $invoice_id = $request->get('invoice_id');
        } else {
            $invoice = Invoice::create([
                'customer_id' => $request->get('customer_id'),
                'invoice_number' => $request->get('invoice_number'),
                'date' => date('Y-m-d', strtotime($request->get('date'))),
                'due_date' => date('Y-m-d', strtotime($request->get('date'))),
                'reference' => $request->get('reference'),
                'project' => $request->get('project')

            ]);
            $invoice_id = $invoice->id;
        }

        foreach ($request->get('items') as $item) {


            $item['invoice_id'] = $invoice_id;
            InvoiceItem::create($item);
        }

    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        foreach ($invoice->items as $item) {
            $item->delete();
        }
        $invoice->delete();
        return redirect('/invoices')->with('status', 'Delete Invoice Success');
    }

    public function show($id)
    {
        $data['invoice'] = Invoice::find($id);
        return view('backend.invoices.show', $data);
    }

    public function addItemsUi($id)
    {
        $data['invoice'] = Invoice::find($id);
        return view('backend.invoices.addItems', $data);

    }

    public function deleteItem($id) {
        $item = InvoiceItem::find($id);
        $item->delete();
        return redirect('/invoices')->with('status', 'Delete Invoice  ItemSuccess');

    }
}
