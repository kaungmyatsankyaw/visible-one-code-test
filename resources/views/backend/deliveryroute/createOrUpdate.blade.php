<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='create-delivery-route'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="{{ isset($route) ? 'Edit Route ' : 'Add New Route' }}"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            @if (isset($route))
                <form method="post" action='{{ url('/edit-delivery-route/' . $route->id) }}' id='checkPointForm'>
                @else
                    <form method="post" action='{{ url('/add-delivery-route') }}' id='checkPointForm'>
            @endif
            @csrf
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Name <span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="name" required id='name'
                            value="{{ old('name', $route->name ?? '') }}" />
                    </div>
                </div>
            </div>
            <input type="hidden" name='checkPoints' id='checkPoints'>
            <div class="row py-2">
                <div class="col-3">
                    <label class="form-label">Add Check Point</label>
                </div>
                <div class="col-2">
                    <button class="btn btn-info" type="button" id='addCheckPoint'>
                        <span style="font-weight: bolder">+ Add</span>
                    </button>
                </div>
            </div>
            <div class="row py-2" id='checkPointList'>
                @php
                    if (isset($route)) {
                        $checkPointLength = isset($route) ? count($route->checkpoint_id) : 2;
                        $checkPointArr = $route->checkpoint_id ?? [];
                    } else {
                        $checkPointLength = 2;
                        $checkPointArr = [];
                    }
                @endphp
                @for ($i = 0; $i < $checkPointLength; $i++)
                    @php
                        $id = $i + 1;
                        $selectedCheckPoint = isset($checkPointArr[$i]) ? $checkPointArr[$i] : null;

                    @endphp
                    @include('backend.deliveryroute.select-checkpoint', [
                        'checkPoints' => $checkPoints,
                        'id' => $id,
                        'selectedCheckPoint' => $selectedCheckPoint,
                    ])
                @endfor
            </div>
            {{-- @include('backend.save-cancel') --}}
            <div class="row mt-4">
                <div class="col-6">
                    <button type="button" class="btn btn-info btn-lg" onclick="checkCheckPoints()">Save</button>
                    <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>

                </div>
            </div>
            </form>
        </div>
    </main>
</x-layout>

<script>
    let i = 2;
    let checkPoints = {!! isset($route) ? json_encode($route->checkpoint_id) : '[]' !!};

    let checkPointId = [];

    if (checkPoints.length > 0) {
        checkPoints.forEach((ch, index) => {
            checkPointId.push({
                key: 'ch-' + (index + 1),
                value: ch
            })
        })
        i = checkPoints.length
    }



    $(document).ready(function() {
        $('#addCheckPoint').on('click', function() {
            i = i + 1;
            $.ajax({
                url: '{{ url('/check-point-ui') }}' + "/" + i,
                method: 'get',
                success: function(data) {
                    $('#checkPointList').append(data);
                }
            });
        });
    });

    function deleteCheckPoint(id) {
        checkPointId = checkPointId.filter(function(item) {
            return item.key !== 'ch-' + id;
        });
        $('#checkPointList-' + id).remove();

        document.getElementById("checkPoints").value = JSON.stringify(checkPointId);
    }

    function addCheckPoindId(e) {
        updateOrPushKeyValue(checkPointId, e.target.id, parseInt(e.target.value));
        document.getElementById("checkPoints").value = JSON.stringify(checkPointId);
    }

    function updateOrPushKeyValue(array, key, value) {
        var found = false;
        for (var i = 0; i < array.length; i++) {
            if (array[i].key === key) {
                array[i].value = value;
                found = true;
                break;
            }
        }
        if (!found) {
            array.push({
                key: key,
                value: value
            });
        }
    }

    function checkCheckPoints() {

        if ($('#name').val() == '' || $('#checkPoints').val() == '') {
            Swal.fire({
                title: 'Error!',
                text: 'Need To Name or CheckPoints',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return
        }
        $('#checkPointForm').submit()
    }
</script>
