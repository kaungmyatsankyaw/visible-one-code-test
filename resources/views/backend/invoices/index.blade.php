<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='invoices'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Invoices"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-invoices') }}"><i
                                    class="material-icons text-sm">add</i>
                                Add New Invoice</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @include('backend.base.alert-success')
                            <div class="table-responsive p-1 m-2">
                                <table class="table  mb-0 " id='myTable'>
                                    <thead>
                                        <tr>
                                            <th class="text-secondary opacity-7">
                                                ID
                                            </th>

                                            <th class="text-secondary opacity-7">
                                                Customer</th>
                                            <th class="text-secondary opacity-7">
                                                Date
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Due Date
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Invoice Number
                                            </th>

                                            <th class="text-secondary opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->id }}</td>
                                                <td>{{ $invoice->customer?->name }}</td>
                                                <td>{{ date('Y-m-d', strtotime($invoice->date)) }}</td>
                                                <td>{{ date('Y-m-d', strtotime($invoice->due_date)) }}</td>
                                                <td>{{ $invoice->invoice_number }}</td>

                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/view-invoice/' . $invoice->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">
                                                            visibility
                                                        </i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/add-invoice-itmes/' . $invoice->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">add</i>
                                                        <div class="ripple-container"></div>
                                                    </a>


                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-invoice/' . $invoice->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                        href="{{ url('/delete-invoice/' . $invoice->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

</x-layout>
