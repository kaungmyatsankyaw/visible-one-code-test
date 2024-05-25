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
            titlePage="{{ isset($goodRecievedNote) ? 'Update Deilivery Order' : 'Add Invoices' }}"></x-navbars.navs.auth>


        @csrf

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-3">
                    <label class="form-label">Cusomter </label>

                    <div class="input-group input-group-outline my-3">
                        <select class="form-control" name='customer' id='customer'>
                            {{-- <option value="null">Select</option> --}}
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <label class="form-label">Date</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="date" id="datepicker" />
                    </div>
                </div>

                <div class="col-3">
                    <label class="form-label">Due Date</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="due_date" id="datepicker-due" />
                    </div>
                </div>

                <div class="col-3">
                    <label class="form-label">Invoice Number <span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="invoice_number" id='invoice_number'
                            value="{{ old('name', $people->name ?? '') }}" required />
                    </div>
                </div>

                <div class="col-3">
                    <label class="form-label">Project</label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="project" id='project'
                            value="{{ old('name', $people->name ?? '') }}" required />
                    </div>
                </div>

                <div class="col-3">
                    <label class="form-label">Reference </label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="reference" id='reference'
                            value="{{ old('name', $people->name ?? '') }}" required />
                    </div>
                </div>

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

        console.log($(e).is(':checked'))

        if ($(e).is(':checked')) {
            console.log(itemId)


            if ($.inArray(itemId, addItemId) === -1) {
                addItemId.push(itemId)

            }

            $('#add-item').attr('disabled', false)

        } else {

            let elementSelector = '#add-item-list-' + itemId


            addItemId = addItemId.filter(n => n != itemId)


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

        let items = []
        let postData = {
            customer_id: $('#customer').val(),
            date: $('#datepicker').val(),
            due_date: $('#datepicker-due').val(),
            invoice_number: $('#invoice_number').val(),
            project: $('#project').val(),
            reference: $('#reference').val()
        }

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
