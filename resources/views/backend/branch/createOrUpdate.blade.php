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

        @if (isset($branch))
            <form method="post" action="{{ url('/edit-branch/' . $branch->id) }}">
            @else
                <form method="post" action={{ url('/create-branches') }}>
        @endif
        @csrf

        <div class="container-fluid py-4">
            <div class="row">
                @foreach ($fields as $field)
                    @if ($field['type'] == 'textarea')
                        <div class="col-8">
                        @else
                            <div class="col-4">
                    @endif

                    <label class="form-label">{{ $field['label'] }}
                        @if ($field['required'])
                            <span class="required">*</span>
                        @endif
                    </label>
                    <div class="input-group input-group-outline my-2">
                        @if ($field['type'] == 'textarea')
                            <textarea cols="20" name='address'>{{ old('address', $branch->address ?? '') }}</textarea>
                        @else
                            <input type="{{ $field['type'] }}" class="form-control" name="{{ $field['name'] }}"
                                value="{{ old($field['name'], $branch->{$field['name']} ?? '') }}"
                                @if ($field['required']) required @endif />
                        @endif
                    </div>
            </div>
            @endforeach
        </div>
        
        @include('backend.save-cancel')
        </form>
    </main>
    <x-plugins></x-plugins>

</x-layout>
