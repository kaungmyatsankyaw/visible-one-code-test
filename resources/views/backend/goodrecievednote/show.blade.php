<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='good-recieved-note'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Good Recieved Note"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <h5>Bl Number - {{ $note->bl_number }}</h5>
            <h5>Date - {{ $note->date }}</h5>
            <h5>Customer - {{ $note->customer?->name }}</h5>
            <hr />
            <div class="py-2 text-2xl">Items</div>
            @foreach ($items as $item)
                <div class="row py-2">
                    <div class="col-3">
                        <label class="form-label">Thai Car Number</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="thai_number"
                                value="{{ $item->thai_number }}" disabled />
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Container Number</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="container_number"
                                value="{{ $item->container_number }}" disabled />
                        </div>
                    </div>
                    <div class="col-1">
                        <label class="form-label">Packing</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="packing" value="{{ $item->packing }}"
                                disabled />
                        </div>
                    </div>
                    <div class="col-1">
                        <label class="form-label">Kg</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="kg" value="{{ $item->kg }}"
                                disabled />
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="form-label">Container Qty</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="container_qty"
                                value="{{ $item->container_qty }}" disabled />
                        </div>
                    </div>
                    <div class="col-2">
                        <label class="form-label">Recieved Qty</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="recieved_qty"
                                value="{{ $item->recieved_qty }}" disabled />
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-3">
                        <label class="form-label">Item Description</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="item_description"
                                value="{{ $item->item_description }}" disabled />
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Drop Point(Check Point)</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='checkpoint' disabled>

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
                            <input type="text" class="form-control" name="remark" value="{{ $item->remark }}"
                                disabled />
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Photo</label>
                        <div class="input-group input-group-outline my-3">
                            <img src=" {{ count($item->getMedia()) !== 0 ? $item->getMedia()[0]->getUrl() : '' }}"
                                class="img-fluid" />
                            {{-- <input type="file" class="form-control"  /> --}}
                        </div>
                    </div>
                </div>
                <hr />
            @endforeach
        </div>
    </main>
</x-layout>
