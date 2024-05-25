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

    #searchListHeader {
        display: none;
        /* padding: 20px; */
        /* background-color: #f0f0f0; */
        /* border: 1px solid #ccc; */
    }
</style>

<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage=""></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth
            titlePage="{{ isset($goodRecievedNote) ? 'Update Deilivery Order' : 'Edit Deilivery Order(DO)' }}"></x-navbars.navs.auth>

        <form method="post">


            @csrf
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">Cusomter </label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='customer' id='customer'>
                                {{-- <option value="null">Select</option> --}}
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if ($order->customer_id === $customer->id) selected @endif>
                                        {{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Choose Route</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='route' id='route'>
                                {{-- <option value="null">Select</option> --}}
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}"
                                        @if ($order->route_id === $route->id) selected @endif>
                                        {{ $route->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Choose Driver</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='driver' id='driver'>
                                {{-- <option value="null">Select</option> --}}
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}"
                                        @if ($order->driver_id === $driver->id) selected @endif>
                                        {{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Choose Car</label>

                        <div class="input-group input-group-outline my-3">
                            <select class="form-control" name='car' id='car'>
                                {{-- <option value="null">Select</option> --}}
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}"
                                        @if ($order->car_id === $car->id) selected @endif>
                                        {{ $car->car_no }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label class="form-label">Date</label>
                        <div class="input-group input-group-outline my-3">
                            <input type="text" class="form-control" name="date" id="datepicker"
                                value={{ date('m/d/Y', strtotime($order->date)) }} />
                        </div>
                    </div>

                </div>



                <div class="row py-2">
                    <div class="col-3">
                        <label class="form-label" style="font-size: 20px;font-weight:bold;color:black">Choose
                            Item</label>
                    </div>
                </div>



                <div class="py-4">
                    <button type="submit" class="btn btn-info btn-lg" id='save'>Save</button>
                    <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>
                </div>

        </form>

    </main>
    <x-plugins></x-plugins>

</x-layout>
