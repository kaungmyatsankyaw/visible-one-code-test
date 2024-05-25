@if (Session::has('status'))
    <div class="alert alert-success alert-dismissible m-2  text-white" role="alert">
        <span class="text-sm">{!! Session::get('status') !!}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
