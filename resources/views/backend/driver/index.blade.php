<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="driver"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Driver Information"></x-navbars.navs.auth>
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

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-driver') }}"><i
                                    class="material-icons text-sm">add</i>
                                Add New Driver</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @include('backend.base.alert-success')
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
                                                NAME</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Phone Number
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Address
                                            </th>
                                            <th class="text-secondary opacity-7">

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($drivers as $driver)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            #{{ $driver->id }}
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        {{ $driver->name }}
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    {{ $driver->email }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $driver->phone }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $driver->location }}
                                                </td>
                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-driver/' . $driver->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                    href="{{ url('/delete-driver/' . $driver->id) }}"
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
