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
         <x-navbars.navs.auth
             titlePage="{{ isset($goodRecievedNote) ? 'Update Note' : 'Add New Note' }}"></x-navbars.navs.auth>

         @if (isset($car))
             <form method="post" action="{{ url('/add-car-truck/' . $car->id) }}">
             @else
                 <form method="post" action={{ url('/add-good-recieved-note') }}>
         @endif
         @csrf

         <div class="container-fluid py-4">
             <div class="row">
                 <div class="col-4">
                     <label class="form-label">Bl Number</label>
                     <div class="input-group input-group-outline my-3">
                         <input type="text" class="form-control" name="bl_number" id='bl_number' />
                     </div>
                 </div>
                 <div class="col-4">
                     <label class="form-label">Date</label>
                     <div class="input-group input-group-outline my-3">
                         <input type="text" class="form-control" name="date" id="datepicker" />
                     </div>
                 </div>
                 <div class="col-4">
                     <label class="form-label">Cusomter Name</label>

                     <div class="input-group input-group-outline my-3">
                         <select class="form-control" name='customer' id='customer'>
                             <option value="null">Select</option>
                             @foreach ($customers as $customer)
                                 <option value="{{ $customer->id }}">
                                     {{ $customer->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-4">
                     <label class="form-label">Branch</label>

                     <div class="input-group input-group-outline my-3">
                         <select class="form-control" name='branch_id' id='branch'>
                             <option value="null">Select</option>
                             @foreach ($branches as $branch)
                                 <option value="{{ $branch->id }}">
                                     {{ $branch->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
             </div>

             <div class="row py-2">
                 <div class="col-3">
                     <label class="form-label" style="font-size: 20px;font-weight:bold;color:black">Add Item</label>
                 </div>
                 <div class="col-2">
                     <button class="btn btn-info btn-lg" type="button" id='addItem'>
                         <span style="font-weight: bolder">+ Add</span>
                     </button>
                 </div>
             </div>

             <div id='itemList'>

             </div>
             <button type="button" class="btn btn-info btn-lg" id='save'>Save</button>
             <button type="button" class="btn btn-info btn-lg" onclick="history.back()">Cancel</button>

             </form>
     </main>
     <x-plugins></x-plugins>

 </x-layout>

 <script>
     let i = 1
     let postData = []
     $(document).ready(function() {

         $.ajax({
             url: '{{ url('/add-item-ui') }}' + "/" + i,
             method: 'get',
             success: function(data) {
                 $('#itemList').append(data);
             }
         })
     })


     $('#addItem').on('click', function() {
         i = i + 1;
         $.ajax({
             url: '{{ url('/add-item-ui') }}' + "/" + i,
             method: 'get',
             success: function(data) {
                 $('#itemList').append(data);
             }
         })
     })

     $('#save').on('click', function() {

         var masterData = new FormData();

         if ($('#bl_number').val() == '' || $('#datepicker').val() == '' || $('#customer').val() == '' || $(
                 '#branch').val() == '') {
             Swal.fire({
                 title: 'Error!',
                 text: 'Need To Choose Data',
                 icon: 'error',
                 confirmButtonText: 'Ok'
             })
             return
         }

         masterData.append('bl_number', $('#bl_number').val())
         masterData.append('date', $('#datepicker').val())
         masterData.append('customer_id', $('#customer').val())
         masterData.append('branch_id', $('#branch').val())

         let isPassed = true

         for (let f = 1; f <= i; f++) {
             var form_data = $('#form-' + f).serializeArray();


             $.each(form_data, function(key, input) {

                 masterData.append(`form-${f}[${input.name}]`, input.value);
             });

             $('#form-' + f).find('input[type="file"]').each(function(index, fileInput) {

                 for (let j = 0; j < fileInput.files.length; j++) {
                     masterData.append(`form-${f}[photo][]`, fileInput.files[j]);
                 }
             });
         }


         //  if (isPassed) {
         $.ajax({
             method: 'POST',
             url: '{{ url('/add-good-recieved-note') }}',
             data: masterData,
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
             },
             contentType: false,
             processData: false,
             success: function(response) {
                //  window.location.href = '/good-recieved-note'
             },
             error: function(error) {
                 console.error('Error:', error);
             }
         })
         //  }

     })

     function removeItemUi(id) {

         $('#item-ui-' + id).remove();
     }
 </script>
