<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='good-recieved-note'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Delivery Order (DO)"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row justify-content-end">
                <div class="col-6">
                    <h5>Customer Name - {{ $order->customer?->name }}</h5>
                    <h5>Driver - {{ $order->driver?->name }}</h5>
                    <h5>Car - {{ $order->car?->car_no }}</h5>
                    <h5>Route - {{ $order->route?->name }}</h5>
                    <h5>Date - {{ $order->date }}</h5>
                </div>
                <div class="col-6">
                    <a href="{{ url('/add-delivery-order-itmes/' . $order->id) }}" role="button" class="btn btn-info">Add
                        Items</a>
                </div>
            </div>

            <hr />
            <div class="py-2 text-2xl text-bolder">Items</div>

            @include('backend.base.alert-success')

            <div class="row   p-3" style="background: white;border-bottom:1px solid black">

                <div class="col-1">
                    <small> Bl Number</small>
                </div>
                <div class="col-1">
                    Client Name
                </div>
                <div class="col-1">
                    <small>Description</small>
                </div>
                <div class="col-2">
                    <small> Container No. or Thai Car </small>
                </div>
                <div class="col-1">
                    Qty In
                </div>
                <div class="col-1">
                    Qty Balance
                </div>
                <div class="col-2">
                    Qty Out
                </div>
                <div class="col-2">
                    Remark
                </div>
            </div>
            @if (count($order->items) === 0)
                <p class="text-center py-5 text-bolder">No Items</p>
            @endif
            @foreach ($order->items as $item)
            
                <div class="row  p-3" style="background: white;border-bottom: 1px solid black">

                    <div class="col-1">
                        {{ $item->orders?->note?->bl_number }}
                    </div>
                    <div class="col-1">
                        {{ $item->orders?->note?->customer?->name }}
                    </div>
                    <div class="col-1">
                        {{ $item->orders?->item_description }}
                    </div>
                    <div class="col-2">
                        {{ $item->orders?->container_number }} - {{ $item->orders?->thai_number }}
                    </div>
                    <div class="col-1">
                        {{ $item->orders?->recieved_qty }}
                    </div>
                    <div class="col-1">
                        <div id='item-qty-balance-{{ $item->id }}'> {{ $item->qty_balance }}</div>
                    </div>
                    <div class="col-2">
                        <div class="input-group input-group-outline  w-50">
                            {{-- <input type='number' class="form-control qtyOut" id='qtyOut-{{ $item->id }}' /> --}}
                            {{-- <button class="btn btn-sm btn-info qtyOut m-2" id='qtyOut-save-{{ $item->id }}'
                                onclick="calBal({{ $item->qty_out }},{{ $item->id }},{{ $item->orders->recieved_qty }})">Save</button> --}}
                            <span id='qtyOut-show-{{ $item->id }}'>{{ $item->qty_out }}</span>
                        </div>
                    </div>
                    <div class="col-1">
                        {{ $item->remark }}
                    </div>
                    <div class="col-2 mt-2">
                        {{-- <button href="" role="button" class="btn btn-info btn-sm"
                            onclick="editQtyOut('{{ $item->id }}','{{ $item->qty_out }}',this)">edit</button> --}}
                        <a href="{{ url('/delete-do-item/' . $item->id) }}" role="button"
                            class="btn btn-danger btn-sm">delete</a>

                    </div>



                </div>
            @endforeach
        </div>
    </main>
</x-layout>

<script>
    $(document).ready(function() {
        $('.qtyOut').hide()
    })

    // function editQtyOut(id, out, e) {

    //     let btnText = $(e).html()
    //     if (btnText !== 'cancel') {


    //         $(e).html('cancel')
    //         $('#qtyOut-' + id).show()
    //         $('#qtyOut-save-' + id).show()

    //         $('#qtyOut-' + id).val(parseInt(out))
    //         $('#qtyOut-show-' + id).empty()
    //     } else {
    //         $('#qtyOut-' + id).hide()
    //         $(e).html('edit')
    //         $('#qtyOut-save-' + id).hide()
    //         $('#qtyOut-show-' + id).html(out)

    //     }
    // }

    // function calBal(out, id, rQty) {
    //     let newOut = parseInt($('#qtyOut-' + id).val())
    //     let bal = parseInt($('#item-qty-balance-' + id).html())

    //     bal = bal - newOut


    //     $('#item-qty-balance-' + id).html(bal)

    //     $.ajax({
    //         url: '{{ url('/edit-do-item/') }}' + '/' + id,

    //     })
    // }
</script>
