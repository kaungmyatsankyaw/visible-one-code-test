<style>
    textarea {
        width: 100%;
        height: 30vh;
        padding: 1em;
        font-size: 1.5em;
        text-align: left;
        border: 1px solid #000;
        resize: none;
    }

    .required {
        color: red !important;
        font-weight: bold;
    }

    #searchListHeader {
        display: none;
        /* padding: 20px; */
        /* background-color: #f0f0f0; */
        /* border: 1px solid #ccc; */
    }
</style>

<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage=""></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth
            titlePage="{{ isset($goodRecievedNote) ? 'Update Deilivery Order' : 'Add Deilivery Order(DO) Items' }}"></x-navbars.navs.auth>


        @csrf

        <div class="container-fluid py-4">
            <div class="row">
                <h5>Customer Name - {{ $order->customer?->name }}</h5>
                <h5>Driver - {{ $order->driver?->name }}</h5>
                <h5>Car - {{ $order->car?->car_no }}</h5>
                <h5>Route - {{ $order->route?->name }}</h5>
                <h5>Date - {{ $order->date }}</h5>
            </div>



            <div class="row py-2">
                <div class="col-3">
                    <label class="form-label" style="font-size: 20px;font-weight:bold;color:black">Choose Item</label>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-3">
                    <div class="input-group input-group-outline">

                        <input type="text" class="form-control" name="search" id="search"
                            aria-describedby="basic-addon1" placeholder="Type Bl No. or Container No. or Description" />
                    </div>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-info" id='add-item'>+ Add</button>
                </div>
            </div>

            <div id="searchListHeader" class="mt-3">
                <div class="row">
                    <div class="col-1"></div>
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
            </div>

            <div id='searchList' class="mt-3">

            </div>

            <div class="row my-3">
                Item List
            </div>

            <div id="" class="">
                <div class="row   p-3" style="background: white;border-bottom:1px solid black">
                    <div class="col-1"></div>
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
            </div>

            <div id='itemList'>

            </div>

            <div class="py-4">
                <button type="button" class="btn btn-info btn-lg" id='save'>Save</button>
                <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>
            </div>

            </form>
    </main>
    <x-plugins></x-plugins>

</x-layout>

<script>
    let i = 1
    let postData = []
    let addItemId = []

    $(document).ready(function() {
        $('#add-item').attr('disabled', 'disabled')
    })

    $('#add-item').on('click', function() {
        let postData = []
        console.log(addItemId)
        addItemId.forEach((i) => {
            let post = {
                item_id: i,
                qtyBal: parseInt($('#balQty-' + i).val()),
                qtyOut: parseInt($('#qtyOut-' + i).val()),
                remark: $('#item-remark-' + i).val()
            }
            let elementSelector = '#add-item-list-' + i
            if ($(elementSelector).length) {
                $(elementSelector).remove()
            }
            postData.push(post)
        })



        $.ajax({
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                data: postData
            },
            url: '{{ url('/add-note-items') }}',
            success: function(data) {

                $('#itemList').append(data)
            }
        })

    })

    function addToItemList(e) {

        let itemId = parseInt($(e).val())

        console.log($(e).is(':checked'))

        if ($(e).is(':checked')) {
            console.log(itemId)


            if ($.inArray(itemId, addItemId) === -1) {
                addItemId.push(itemId)

            }

            $('#add-item').attr('disabled', false)

        } else {

            let elementSelector = '#add-item-list-' + itemId

            // if (!$(elementSelector).length) {
            addItemId = addItemId.filter(n => n != itemId)
            // }

            console.log('len', addItemId.length)
            if (addItemId.length === 0) {
                $('#add-item').attr('disabled', 'disabled')

            }
        }

    }


    let timeout = null;

    document.getElementById('search').addEventListener('input', function() {

        if (timeout) {
            clearTimeout(timeout);
        }


        timeout = setTimeout(() => {

            const value = this.value

            if (value === '') {

                $('#searchList').empty()
                $('#searchListHeader').hide()
                return
            }

            $.ajax({
                url: '{{ url('/search-note-item') }}',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    search: value,
                },
                success: function(data) {
                    $('#searchListHeader').show()
                    $('#searchList').append(data)
                }
            })


        }, 500)
    });

    function removeItemUi(id) {

        $('#item-ui-' + id).remove();
    }

    function calQtyBalance(id, input) {
        let recQty = $('#recQty-' + id).val()
        if (input.value == '') {
            $('#item-qty-balance-' + id).html(recQty)
            return
        }

        let qtyOut = parseInt(input.value)

        if (input.value < 1) {
            alert('Amount is worng')
            return false
        }

        if (qtyOut > recQty) {
            return false
        }

        let qtyBal = recQty - qtyOut

        $('#balQty-' + id).val(qtyBal)
        $('#qtyOut-' + id).val(qtyOut)


        $('#item-qty-balance-' + id).html(qtyBal)

    }

    $('#save').on('click', function() {

        if (addItemId.length === 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Need To Add Items or Date',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return
        }

        let items = []
        let postData = {
            order_id: parseInt('{{ $order->id }}')
        }

        addItemId.forEach((i) => {
            let elementSelector = '#add-item-list-' + i

            if ($(elementSelector).length) {
                let post = {
                    item_id: i,
                    qty_balance: parseInt($('#balQty-' + i).val()),
                    qty_out: parseInt($('#qtyOut-' + i).val()),
                    remark: $('#item-remark-' + i).val()
                }
                items.push(post)
            }

        })

        postData['items'] = items

        $.ajax({
            method: 'post',
            data: postData,
            url: '{{ url('/add-delivery-order') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Adding Success',
                    icon: 'info',
                    confirmButtonText: 'Ok'
                }).then(function() {
                    window.location.href = '{{ url('/delivery-order') }}'
                })
            }
        })

    })

    function deleteUi(id) {
        $('#add-item-list-' + id).remove()

        // addItemId = addItemId.filter(i => i !== parseInt(id))
    }
</script>
