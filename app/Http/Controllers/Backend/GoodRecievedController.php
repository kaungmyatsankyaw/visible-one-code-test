<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Checkpoint;
use App\Models\GoodRecievedNote;
use App\Models\GoodRecievedNoteItem;
use App\Models\Branch;

class GoodRecievedController extends Controller
{
    public function index()
    {
        $data['notes'] = GoodRecievedNote::all()->sortByDesc('created_at');

        return view('backend.goodrecievednote.index', $data);
    }

    public function create()
    {
        $data['customers'] = Customer::all();
        $data['checkPoints'] = Checkpoint::all();
        $data['branches'] = Branch::all();
        return view('backend.goodrecievednote.createOrUpdate', $data);
    }

    public function addItemUi(Request $request, $id)
    {
        $data['edit_new'] = false;

        if ($request->has('type')) {
            $data['edit_new'] = true;
            $data['note_id'] = intval($request->get('note_id'));
        }

        $data['customers'] = Customer::all();
        $data['checkPoints'] = Checkpoint::all();
        $data['id'] = $id;
        return view('backend.goodrecievednote.item', $data);
    }

    public function store(Request $request)
    {
        $recievedNote = GoodRecievedNote::create([
            'bl_number' => $request->get('bl_number'),
            'customer_id' => intval($request->get('customer_id')),
            'date' => date('Y-m-d', strtotime($request->get('date'))),
            'branch_id' => $request->get('branch_id')
        ]);

        $form = [];

        foreach ($request->except('bl_number', 'customer_id', 'date', 'branch_id') as $formKey => $formData) {

            $form[] = $formData;

            $itemData = [];

            $itemData['note_id'] = $recievedNote->id;

            foreach ($formData as $key => $value) {

                if ($key !== 'photo') {

                    $itemData[$key] = $value;
                }
            }

            $itemData['qty_balance'] = $itemData['recieved_qty'];



            $noteItem = GoodRecievedNoteItem::create($itemData);

            if (isset($formData['photo'])) {
                foreach ($formData['photo'] as $file) {
                    $noteItem->addMedia($file)
                        ->toMediaCollection();
                }
            }
        }

        return response()->json(['status' => 1], 200);
    }



    public function delete($id)
    {
        return view('backend.goodrecievednote.index');
    }

    public function show($id)
    {
        $note = GoodRecievedNote::with('items')->find($id);
        $data['items'] = $note->items;

        $data['note'] = $note;
        $data['checkPoints'] = Checkpoint::all();
        return view('backend.goodrecievednote.show', $data);
    }

    public function edit($id)
    {
        $note = GoodRecievedNote::with('items')->find($id);
        $data['items'] = $note->items;

        $data['note'] = $note;
        $data['checkPoints'] = Checkpoint::all();
        $data['customers'] = Customer::all();
        $data['branches'] = Branch::all();
        return view('backend.goodrecievednote.edit', $data);
    }



    public function deleteItem($id)
    {
        $item = GoodRecievedNoteItem::find($id);
        $item->media()->delete();
        GoodRecievedNoteItem::destroy($id);
        return response()->json(['status' => 1], 200);
    }

    public function updateItem(Request $request, $id)
    {
        foreach ($request->all() as $formKey => $formData) {

            $itemData = [];

            foreach ($formData as $key => $value) {

                if ($key !== 'photo' && $key !== 'note_id') {

                    $itemData[$key] = $value;
                }

                if ($key === 'note_id') {
                    $note_id = $value;
                }

                $item = GoodRecievedNoteItem::where('note_id', intval($note_id))->first();

                $item->update($itemData);
            }

            // $noteItem = GoodRecievedNoteItem::create($itemData);

            if (isset($formData['photo'])) {
                foreach ($formData['photo'] as $file) {
                    $item->media()->delete();
                    $item->addMedia($file)
                        ->toMediaCollection();
                }
            }
        }

        return response()->json(['status' => 1], 200);
    }

    public function addNewItemsNote(Request $request)
    {

        foreach ($request->all() as $formKey => $formData) {

            $itemData = [];

            foreach ($formData as $key => $value) {

                if ($key !== 'photo') {

                    $itemData[$key] = $value;
                }

            }

            $item = GoodRecievedNoteItem::create($itemData);

            if (isset($formData['photo'])) {
                foreach ($formData['photo'] as $file) {
                    $item->media()->delete();
                    $item->addMedia($file)
                        ->toMediaCollection();
                }
            }
        }

        return response()->json(['status' => 1], 200);
    }

    public function deleteNote($id)
    {
        $note = GoodRecievedNote::find($id);
        $items = $note->items;
        foreach ($items as $item) {
            $item->media()->delete();
            $item->delete();
        }
        $note->delete();
        return redirect('/good-recieved-note')->with('status', 'Note delete success');
    }

    public function update(Request $request, $id)
    {
        // dd($request->get('date'));
        // dd(date('Y-m-d', strtotime($request->get('date'))));
        $note = GoodRecievedNote::find($id);
        $note->update([
            'bl_number' => $request->get('bl_number'),
            'customer_id' => intval($request->get('customer')),
            'date' => date('Y-m-d', strtotime($request->get('date'))),
            'branch_id' => $request->get('branch_id')
        ]);
        return redirect('/good-recieved-note')->with('status', 'Note Update success');

    }
}
