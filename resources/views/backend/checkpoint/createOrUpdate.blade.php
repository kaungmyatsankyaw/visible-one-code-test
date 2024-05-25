<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage=""></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="{{ isset($checkPoint) ? 'Edit Check Point' : 'Add New Check Point' }}"></x-navbars.navs.auth>
        <!-- End Navbar -->

        @if (isset($checkPoint))
            <form method="post" action={{ url('/edit-checkpoint/' . $checkPoint->id) }}>
            @else
                <form method="post" action={{ url('/add-checkpoint') }}>
        @endif
        @csrf

        <div class="container-fluid py-4">


            <div class="row">
                <div class="col-4">
                    <label class="form-label">Name <span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="name" required
                            value="{{ old('name', $checkPoint->name ?? '') }}" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">City <span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="city" required
                            value="{{ old('name', $checkPoint->city ?? '') }}" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">State<span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="state" required
                            value="{{ old('name', $checkPoint->state ?? '') }}" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">Country<span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="text" class="form-control" name="country" required
                            value="{{ old('name', $checkPoint->country ?? '') }}" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">Zip Code<span class="required">*</span></label>
                    <div class="input-group input-group-outline my-2">
                        <input type="number" class="form-control" name="zip_code" required
                            value="{{ old('name', $checkPoint->zip_code ?? '') }}" />
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-8">
                    <label class="form-label">Address</label>
                    <div class="input-group input-group-outline my-2" style="width: 100%">
                        <textarea cols="20" name='address'>{{ old('detail', $checkPoint->address ?? '') }}</textarea>
                    </div>
                </div>

            </div>
            @include('backend.save-cancel')
            </form>
    </main>


</x-layout>
