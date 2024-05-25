<div style="border: 1px solid black" class="p-2 my-2" id='item-ui-{{ $id }}'>
    <div class="row justify-content-end">

        <div class="col-1 ml-2">
            <button class="btn btn-danger" type="button" onclick="removeItemUi('{{ $id }}')">Remove</button>
        </div>
    </div>

    @if ($edit_new)
        <form id='form-edit-new-{{ $id }}' enctype="multipart/form-data">
            <input type="hidden" value="{{ $note_id }}" name='note_id' />
        @else
            <form id='form-{{ $id }}' enctype="multipart/form-data">
    @endif
    <div class="row py-2">
        <div class="col-3">
            <label class="form-label">Thai Car Number</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="thai_number" />
            </div>
        </div>
        <div class="col-3">
            <label class="form-label">Container Number</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="container_number" />
            </div>
        </div>
        <div class="col-1">
            <label class="form-label">Packing</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="packing" />
            </div>
        </div>
        <div class="col-1">
            <label class="form-label">Kg</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="kg" />
            </div>
        </div>
        <div class="col-2">
            <label class="form-label">Container Qty</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="container_qty" />
            </div>
        </div>
        <div class="col-2">
            <label class="form-label">Recieved Qty</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="recieved_qty" />
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-3">
            <label class="form-label">Item Description</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="item_description" />
            </div>
        </div>
        <div class="col-3">
            <label class="form-label">Drop Point(Check Point)</label>

            <div class="input-group input-group-outline my-3">
                <select class="form-control" name='checkpoint'>
                    <option value="null">Select</option>
                    @foreach ($checkPoints as $checkPoint)
                        <option value="{{ $checkPoint->id }}">
                            {{ $checkPoint->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <label class="form-label">Remark</label>
            <div class="input-group input-group-outline my-3">
                <input type="text" class="form-control" name="remark" />
            </div>
        </div>
        <div class="col-3">
            <label class="form-label">Photo Upload</label>
            <div class="input-group input-group-outline my-3">
                <input type="file" class="form-control" name="item-photo-{{ $id }}"
                    id='item-photo-{{ $id }}' />
            </div>
        </div>
    </div>
    </form>
</div>
