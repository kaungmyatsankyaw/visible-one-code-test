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
</style>

<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage=""></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="{{ $page_title }}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Name <span class="required">*</span></label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $people->name ?? '') }}" required />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Email</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="email" class="form-control" name="email"
                                value="{{ old('name', $people->email ?? '') }}" />
                        </div>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Phone Number <span class="required">*</span></label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('name', $people->phone ?? '') }}" required />
                        </div>
                    </div>
                </div>
                @if ($type === 'driver')
                    <div class="row">
                        @if (isset($show_password) && $show_password)
                            <div class="col-4">
                                <label class="form-label">Password<span class="required">*</span></label>
                                <div class="input-group input-group-outline my-2">
                                    <input type="text" class="form-control" name="password" required />
                                </div>
                            </div>
                        @endif
                        <div class="col-4">
                            <label class="form-label">Driver License<span class="required">*</span></label>
                            <div class="input-group input-group-outline my-2">
                                <input type="text" class="form-control"
                                    value="{{ old('driving_license', $people->driving_license ?? '') }}"
                                    name="driving_license" required />
                            </div>
                        </div>

                        <div class="col-4">
                            <label class="form-label">NRC<span class="required">*</span></label>
                            <div class="input-group input-group-outline my-2">
                                <input type="text" class="form-control" name="nrc" required
                                    value="{{ old('nrc', $people->nrc ?? '') }}" />
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">City</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="city"
                                value="{{ old('city', $people->city ?? '') }}" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">State</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="state"
                                value="{{ old('state', $people->state ?? '') }}" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Country</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="text" class="form-control" name="country"
                                value="{{ old('country', $people->country ?? '') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">Zip Code</label>
                        <div class="input-group input-group-outline my-2">
                            <input type="number" class="form-control" name="zip_code"
                                value="{{ old('zip_code', $people->zip_code ?? '') }}" />
                        </div>
                    </div>
                    <div class="col-8">
                        <label class="form-label">Address</label>
                        <div class="input-group input-group-outline my-2" style="width: 100%">
                            @if ($type == 'driver')
                                <textarea cols="20" name='location'>{{ old('location', $people->location ?? '') }}</textarea>
                            @else
                                <textarea cols="20" name='address'>{{ old('address', $people->address ?? '') }}</textarea>
                            @endif
                        </div>
                    </div>

                </div>
                @include('backend.save-cancel')
        </form>
    </main>
    <x-plugins></x-plugins>

</x-layout>
