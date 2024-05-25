<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="branch-manager"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Branch Manager"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">

                            <a class="btn bg-gradient-dark mb-0" href="{{ url('/add-branch-manager') }}"><i
                                    class="material-icons text-sm">add</i>
                                Add New Branch Manager</a>
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
                                            <th lass="text-secondary opacity-7">
                                                Branch
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                NAME</th>
                                            <th class="text-secondary opacity-7">
                                                EMAIL
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Phone Number
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Address
                                            </th>
                                            <th class="text-secondary opacity-7">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($managers as $manager)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">

                                                        #{{ $manager->id }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="">
                                                       {{ $manager->branch->name }} 
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="">
                                                        {{ $manager->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $manager->email }}
                                                </td>
                                                <td>
                                                    {{ $manager->phone }}
                                                </td>
                                                <td>
                                                    {{ $manager->address }}
                                                </td>
                                                <td class="align-middle">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ url('/edit-branch-manager/' . $manager->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <a rel="tooltip" class="btn btn-danger btn-link"
                                                        href="{{ url('/delete-branch-manager/' . $manager->id) }}"
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
