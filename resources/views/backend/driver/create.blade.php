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
</style>

<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="driver"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add New Driver"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Name</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="name" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">Email</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="email" class="form-control" name="email" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="phone_number" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">City</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="city" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">State</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="email" class="form-control" name="state" />
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">Country</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" name="country" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">Zip Code</label>
                    <div class="input-group input-group-outline my-3">
                        <input type="email" class="form-control" name="state" />
                    </div>
                </div>
                <div class="col-8">
                    <label class="form-label">Address</label>
                    <div class="input-group input-group-outline my-3" style="width: 100%">
                        <textarea cols="20"></textarea>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
