<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="checkpoint"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Customer"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class=" col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" name="search" id='search-driver'
                            onfocusout="defocused(this)">
                    </div>
                </div>
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-checkpoint') }}"><i
                                    class="material-icons text-sm">add</i>Add New Check Point</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @include('backend.base.alert-success')
                            <div class="table-responsive p-1 m-2">
                                <table class="table align-items-center mb-0 " id='myTable'>
                                    <thead>
                                        <tr>
                                            <th class="text-secondary opacity-7">
                                                ID
                                            </th>

                                            <th class="text-secondary opacity-7">
                                                NAME</th>
                                            <th class="text-secondary opacity-7 ">
                                                City
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                State
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Country
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Zip Code
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkPoints as $checkPoint)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $checkPoint->id }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $checkPoint->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $checkPoint->city }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $checkPoint->state }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $checkPoint->country }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column ">
                                                            {{ $checkPoint->zip_code }}
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-checkpoint/' . $checkPoint->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                        href="{{ url('/delete-checkpoint/' . $checkPoint->id) }}"
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
    <x-plugins></x-plugins>

</x-layout>
