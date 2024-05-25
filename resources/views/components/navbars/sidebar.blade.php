@props(['activePage'])



<style>
    .navbar-vertical .navbar-nav .nav-link {
        padding-left: 1rem;
        padding-right: 1rem;
        font-weight: 300;
        color: black !important;
    }
</style>

@php
    $navs = Config::get('navs');
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer  opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            {{-- <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <span class=" font-weight-bold text-large h4">S & H Logistics</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  " id="sidenav-collapse-main" style="height: 100% !important">
        <ul class="navbar-nav">
            {{-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs  font-weight-bolder opacity-8">Laravel examples</h6>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link  {{ $activePage == 'user-profile' ? 'active bg-gradient-info' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ $activePage == 'user-management' ? ' active bg-gradient-info' : '' }} "
                    href="{{ route('user-management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li> --}}
            @foreach ($navs as $nav)
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == $nav['activePage'] ? ' active bg-gradient-info' : '' }} "
                        href="{{ url($nav['route']) }}">
                        <div class=" text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">{{ $nav['icon'] }}</i>
                        </div>
                        <span class="nav-link-text ms-1">{{ $nav['label'] }}</span>
                    </a>
                </li>
            @endforeach


        </ul>
    </div>

</aside>
