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
            titlePage="{{ isset($goodRecievedNote) ? 'Update Deilivery Order' : 'Add Invoices Items' }}"></x-navbars.navs.auth>


        @csrf

        <div class="container-fluid py-4">
            <div class="row">
                <h5>Customer Name - {{ $invoice->customer?->name }}</h5>
                <h5>Date - {{ $invoice->date }}</h5>
                <h5>Due Date - {{ $invoice->due_date }}</h5>
                <h5>Invoice Number - {{ $invoice->invoice_number }}</h5>
                <h5>Project - {{ $invoice->project }}</h5>
                <h5>Reference - {{ $invoice->reference }}</h5>

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
                        <small> Description</small>
                    </div>
                    <div class="col-1">
                        Kg
                    </div>

                    <div class="col-1">
                        <small> Container No. </small>
                    </div>
                    <div class="col-1">
                        Qty
                    </div>
                    <div class="col-1">
                        Unit Price
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
                        <small> Description</small>
                    </div>
                    <div class="col-1">
                        Kg
                    </div>

                    <div class="col-1">
                        <small> Container No. </small>
                    </div>
                    <div class="col-1">
                        Qty
                    </div>
                    <div class="col-1">
                        Unit Price
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
        addItemId.forEach((i) => {
            let post = {
                item_id: i,
                unitPrice: parseInt($('#item-unitprice-' + i).val()),
                qty: parseInt($('#item-qty-' + i).val()),

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
            url: '{{ url('/add-invoices-items') }}',
            success: function(data) {
                $('#itemList').append(data)
            }
        })

    })

    function addToItemList(e) {

        let itemId = parseInt($(e).val())

        if ($(e).is(':checked')) {
            if ($.inArray(itemId, addItemId) === -1) {
                addItemId.push(itemId)
            }

            $('#add-item').attr('disabled', false)

        } else {

            let elementSelector = '#add-item-list-' + itemId
            addItemId = addItemId.filter(n => n != itemId)

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
                url: '{{ url('/search-invoices-note-item') }}',
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

        let postData = {
            invoice_id: parseInt('{{ $invoice->id }}')
        }

        let items = []


        addItemId.forEach((i) => {
            let elementSelector = '#add-item-list-' + i

            if ($(elementSelector).length) {
                let post = {
                    item_id: i,
                    unit_price: parseInt($('#item-unitprice-' + i).val()),
                    qty: parseInt($('#item-qty-' + i).val()),

                }
                items.push(post)
            }

        })



        postData['items'] = items
        

        $.ajax({
            method: 'post',
            data: postData,
            url: '{{ url('/add-invoices') }}',
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
                    window.location.href = '{{ url('/invoices') }}'
                })
            }
        })

    })

    function deleteUi(id) {
        $('#add-item-list-' + id).remove()
        // addItemId = addItemId.filter(i => i !== parseInt(id))
    }
</script>
