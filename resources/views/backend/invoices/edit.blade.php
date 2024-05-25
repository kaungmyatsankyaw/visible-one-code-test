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
            titlePage="{{ isset($goodRecievedNote) ? 'Update Deilivery Order' : 'Edit Deilivery Order(DO)' }}"></x-navbars.navs.auth>

        <form method="post">


            @csrf
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Cusomter </label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='customer_id' id='customer'>
                                {{-- <option value="null">Select</option> --}}
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if ($invoice->customer_id === $customer->id) selected @endif>
                                        {{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Date</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control"  value="{{ date('d/m/Y', strtotime($invoice->date)) }}" name="date" id="datepicker" />
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Due Date</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control"
                                value="{{ date('d/m/Y', strtotime($invoice->due_date)) }}" name="due_date"
                                id="datepicker-due" />
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Invoice Number <span class="required">*</span></label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="invoice_number" id='invoice_number'
                                value="{{ $invoice->invoice_number }}" required />
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Project</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="project" id='project'
                                value="{{ $invoice->project }}" />
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Reference </label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="reference" id='reference'
                                value="{{ $invoice->reference }}" />
                        </div>
                    </div>

                </div>



                <div class="row py-2">
                    <div class="col-3">
                        <label class="form-label" style="font-size: 20px;font-weight:bold;color:black">Choose
                            Item</label>
                    </div>
                </div>



                <div class="py-4">
                    <button type="submit" class="btn btn-info btn-lg" id='save'>Save</button>
                    <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>
                </div>

        </form>

    </main>
    <x-plugins></x-plugins>

</x-layout>
