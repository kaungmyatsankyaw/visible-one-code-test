<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="branches"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Branches"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/create-branches') }}"><i
                                    class="material-icons text-sm">add</i>Add New Branch</a>
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
                                                Name</th>

                                            <th class="text-secondary opacity-7">
                                                City
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                State
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Country
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $branch)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $branch->id }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="">
                                                            {{ $branch->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                               
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column ">
                                                            {{ $branch->city }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column ">
                                                            {{ $branch->state }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column ">
                                                            {{ $branch->country }}
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-branch/' . $branch->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                        href="{{ url('/delete-branch/' . $branch->id) }}"
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
