<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='delivery-route'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Route"></x-navbars.navs.auth>

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

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-delivery-route') }}"><i
                                    class="material-icons text-sm">add</i>
                                Add New Delivery Route</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-1 m-2">
                                <table class="table align-items-center mb-0 " id='myTable'>
                                    <thead>
                                        <tr>
                                            <th class="text-secondary opacity-7">
                                                ID
                                            </th>

                                            <th class="text-secondary opacity-7">
                                                NAME</th>
                                            <th class="text-secondary opacity-7">
                                                CheckPoint
                                            </th>

                                            <th class="text-secondary opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($routes as $route)
                                            @php

                                                $checkPointName = collect($route->checkpoint_id)
                                                    ->map(function ($id) use ($checkPoints) {
                                                        return $checkPoints->where('id', $id)->pluck('name')->first();
                                                    })
                                                    ->toArray();
                                                
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column ">
                                                        {{ $route->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column ">
                                                        {{ $route->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        {!! implode('->', $checkPointName) !!}
                                                    </div>

                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-delivery-route/' . $route->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                    href="{{ url('/delete-delivery-route/' . $route->id) }}"
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
