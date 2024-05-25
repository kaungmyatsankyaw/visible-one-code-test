<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='good-recieved-note'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Good Recieved Note"></x-navbars.navs.auth>

        <div class="container-fluid py-4">


            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Bl Number</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="bl_number" value="{{ $note->bl_number }}"
                                id='bl_number' />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Date</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="date"
                                value="{{ date('d/m/Y', strtotime($note->date)) }}" id="datepicker" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Cusomter Name</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='customer' id='customer'>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if ($note->customer_id === $customer->id) selected @endif>
                                        {{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Branch</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='branch_id' id='branch'>
                                <option value="0">Select</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        @if ($note->branch_id == $branch->id) selected @endif>
                                        {{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-info ">Update</button>
                    </div>
                </div>
            </form>

            <hr />
            <div class="row py-2">
                <div class="col-3">
                    <label class="form-label" style="font-size: 20px;font-weight:bold;color:black">Items</label>
                </div>
                <div class="col-2">
                    <button class="btn btn-info btn-lg" type="button" id='addItem'>
                        <span style="font-weight: bolder">+ Add</span>
                    </button>
                </div>
            </div>
            <div id="itemList">
                @foreach ($items as $item)
                    <form id='form-{{ $item->id }}' enctype="multipart/form-data">
                        <input type="hidden" value="{{ $note->id }}" name="note_id" />
                        <div style="border: 1px solid black" class="p-2 my-2">
                            <div class="row justify-content-end">
                                <div class="col-1">
                                    <button class="btn btn-info" type="button"
                                        onclick="updateItem('{{ $item->id }}')">Edit</button>
                                </div>
                                <div class="col-1"><button class="btn btn-danger"
                                        onclick="removeItem('{{ $item->id }}')" type="button">Remove</button></div>

                            </div>
                            <div class="row py-2">
                                <div class="col-3">
                                    <label class="form-label">Thai Car Number</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="thai_number"
                                            value="{{ $item->thai_number }}" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Container Number</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="container_number"
                                            value="{{ $item->container_number }}" />
                                    </div>
                                </div>
                                <div class="col-1">
                                    <label class="form-label">Packing</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="packing"
                                            value="{{ $item->packing }}" />
                                    </div>
                                </div>
                                <div class="col-1">
                                    <label class="form-label">Kg</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="kg"
                                            value="{{ $item->kg }}" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Container Qty</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="container_qty"
                                            value="{{ $item->container_qty }}" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Recieved Qty</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="recieved_qty"
                                            value="{{ $item->recieved_qty }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-3">
                                    <label class="form-label">Item Description</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="item_description"
                                            value="{{ $item->item_description }}" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Drop Point(Check Point)</label>

                                    <div class="input-group input-group-outline my-3">
                                        <select class="form-control" name='checkpoint'>

                                            @foreach ($checkPoints as $checkPoint)
                                                <option value="{{ $checkPoint->id }}"
                                                    @if ($checkPoint->id === $item->checkpoint_id) required @endif>
                                                    {{ $checkPoint->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Remark</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control" name="remark"
                                            value="{{ $item->remark }}" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Photo</label>
                                    <div class="input-group input-group-outline my-3">
                                        <input type="file" class="form-control mb-3" />


                                        <img src=" {{ count($item->getMedia()) !== 0 ? $item->getMedia()[0]->getUrl() : '' }}"
                                            class="img-fluid" />

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                @endforeach
            </div>
            <button type="button" class="btn btn-info btn-lg" id='save'>Save</button>
            <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>
        </div>
    </main>
</x-layout>

<script>
    let i = {{ $note->items->count() }}
    let newItem = 0
    let newItemArr = []

    $(document).ready(function() {
        $('#save').attr('disabled', 'disabled')
    })

    $('#addItem').on('click', function() {
        i = i + 1;
        newItem += 1
        newItemArr.push(i)
        console.log(newItemArr)
        $.ajax({
            url: '{{ url('/add-item-ui') }}' + "/" + i + '?type=edit-save&note_id=' +
                {{ $note->id }},
            method: 'get',
            success: function(data) {
                $('#itemList').append(data);
                $('#save').removeAttr('disabled')
            }
        })
    })

    function removeItemUi(id) {

        newItem -= 1
        if (newItem === 0) {
            $('#save').attr('disabled', 'disabled')

        }
        const index = newItemArr.indexOf(parseInt(id))

        if (index > -1) {
            newItemArr.splice(index, 1);
        }
        $('#item-ui-' + id).remove();

    }

    function updateItem(id) {
        var masterData = new FormData()

        var form_data = $('#form-' + id).serializeArray()

        $.each(form_data, function(key, input) {
            masterData.append(`form-${id}[${input.name}]`, input.value)
        })

        $('#form-' + id).find('input[type="file"]').each(function(index, fileInput) {

            for (let j = 0; j < fileInput.files.length; j++) {
                masterData.append(`form-${id}[photo][]`, fileInput.files[j]);
            }
        })

        $.ajax({
            method: 'POST',
            url: '{{ url('/update-good-recieved-item') }}' + '/' + id,
            data: masterData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            contentType: false,
            processData: false,
            success: function(response) {
                window.location.href = '/good-recieved-note'
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });

    }

    $('#save').on('click', function() {
        var masterData = new FormData()


        for (var n = 0; n <= newItemArr.length; n++) {

            var form_data = $('#form-edit-new-' + newItemArr[n]).serializeArray()


            $.each(form_data, function(key, input) {
                masterData.append(`form-${newItemArr[n]}[${input.name}]`, input.value)
            })

            $('#form-edit-new-' + newItemArr[n]).find('input[type="file"]').each(function(index, fileInput) {

                for (let j = 0; j < fileInput.files.length; j++) {
                    masterData.append(`form-${newItemArr[n]}[photo][]`, fileInput.files[j]);
                }
            })
        }


        $.ajax({
            method: 'POST',
            url: '{{ url('/add-good-recieved-note-item') }}' + '/' + {{ $note->id }},
            data: masterData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            contentType: false,
            processData: false,
            success: function(response) {
                window.location.href = '/good-recieved-note'
            },
            error: function(error) {
                console.error('Error:', error);
            }
        })
    })

    function removeItem(id) {
        $.ajax({
            method: 'get',
            url: '{{ url('/delete-good-recieved-item/') }}' + '/' + id,
            success: function(data) {
                window.location.reload()
            }
        })
    }
</script>
