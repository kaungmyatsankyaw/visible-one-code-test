<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='good-recieved-note'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Invoice"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row justify-content-end">
                <div class="col-6">
                    <h5>Customer Name - {{ $invoice->customer?->name }}</h5>
                    <h5>Date - {{ $invoice->date }}</h5>
                    <h5>Due Date - {{ $invoice->due_date }}</h5>
                    <h5>Invoice Number - {{ $invoice->invoice_number }}</h5>
                    <h5>Project - {{ $invoice->project }}</h5>
                    <h5>Reference - {{ $invoice->reference }}</h5>

                </div>
                <div class="col-6">
                    <a href="{{ url('/add-invoice-itmes/' . $invoice->id) }}" role="button" class="btn btn-info">Add
                        Items</a>
                </div>
            </div>

            <hr />
            <div class="py-2 text-2xl text-bolder">Items</div>

            @include('backend.base.alert-success')

            <div class="row   p-3" style="background: white;border-bottom:1px solid black">

                <div class="col-1">
                    <small> Description</small>
                </div>
                <div class="col-1">
                    Kg
                </div>

                <div class="col-2">
                    <small> Container No </small>
                </div>
                <div class="col-1">
                    Qty
                </div>
                <div class="col-1">
                    Unit Price
                </div>
                <div class="col-2"></div>
            </div>
            @if ($invoice->item && count($invoice->items) === 0)
                <p class="text-center py-5 text-bolder">No Items</p>
            @endif
            @foreach ($invoice->items as $item)
                <div class="row  p-3" style="background: white;border-bottom: 1px solid black">

                    <div class="col-1">
                        {{ $item->invoices?->item_description }}
                    </div>
                    <div class="col-1">
                        {{ $item->invoices?->kg }}
                    </div>
                    <div class="col-2">
                        {{ $item->invoices?->container_number }}
                    </div>

                    <div class="col-1">
                        {{ $item->invoices->invoices[0]->qty }}
                    </div>
                    <div class="col-1">
                        <div id='item-qty-balance-{{ $item->id }}'>{{ $item->invoices->invoices[0]->unit_price }}
                        </div>
                    </div>


                    <div class="col-2 mt-2">
                        {{-- <button href="" role="button" class="btn btn-info btn-sm"
                            onclick="editQtyOut('{{ $item->id }}','{{ $item->qty_out }}',this)">edit</button> --}}
                        <a href="{{ url('/delete-invoice-item/' . $item->id) }}" role="button"
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
