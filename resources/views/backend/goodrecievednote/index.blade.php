<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='good-recieved-note'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Good Recieved Note"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-good-recieved-note') }}"><i
                                    class="material-icons text-sm">add</i>Add New Note</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @include('backend.base.alert-success')
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0 m-2">
                                    <table class="table align-items-center mb-0" id='myTable'>
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID
                                                </th>

                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Bl Number</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Date
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Customer
                                                </th>

                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Branch
                                                </th>

                                                <th class="text-secondary opacity-7">

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notes as $note)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">

                                                        #{{ $note->id }}

                                                    </td>

                                                    <td class="align-middle text-center text-sm">

                                                        {{ $note->bl_number }}

                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $note->date }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ $note->customer?->name }}
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        {{ $note->branch?->name }}
                                                    </td>

                                                    <td class="align-middle">
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ url('/view-good-recieved-note/' . $note->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">
                                                                visibility
                                                            </i>
                                                            <div class="ripple-container"></div>
                                                        </a>

                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ url('/edit-good-recieved-note/' . $note->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>

                                                        <a rel="tooltip" class="btn btn-danger btn-link"
                                                            href="{{ url('/delete-good-recieved-note/' . $note->id) }}"
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
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

</x-layout>
