<div>

    <nav class="navbar navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand text-success">Banners &nbsp; / &nbsp; {{ $company->name }}</a>
          <a class="navbar-brand btn btn-success text-white" href="{{ route('livewire.company') }}">Back</a>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    {{-- <h6 class="card-title text-center"> &emsp; Company Wide Banners &emsp; --}}
                        {{-- <span class="d-flex justify-content-between">
                        <button wire:click="show('showVideo')" class="btn btn-primary btn-icon-text btn-edit-profile" >Add Video Banner</button>
                        <button wire:click="show('showImage')" class="btn btn-primary btn-icon-text btn-edit-profile" >Add Image Banner</button>
                        </span> --}}

                        {{-- <form action="/banners/{{ $ids }}" class="dropzone" id="my-awesome"> --}}

                    {{-- <span class="d-flex justify-content-between">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    </span> --}}

                        {{-- </form> --}}

                    {{-- @if($showVideo == true) --}}
                        {{-- <div>
                          <livewire:banner.store-video-banner :companyID="$ids"/>
                        </div> --}}
                    {{-- <div class="form-group">
                            <form wire:submit.prevent="storeVideo({{ $ids }})" action="/banners/{{ $ids }}" wire:model.defer="dropzone" class="dropzone">
                        
                            <input class="form-control d-flex justify-content-center col-md-1" type="submit"> 
                        </form>
                    </div> --}}

                    {{-- <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Select Image</h3>
                        </div>
        
                        <div class="panel-body">
                            
                            <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                            @csrf 
        
                            </form>
        
                            <div align="center">
                                <button type="button" class="btn btn-success" id="submit-all">Upload</button>
                            </div>
                        </div>
                        
                    </div> --}}

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title mb-5 text-center"> Company Banners</h3>
                        </div>
        
                        <div class="panel-body">
                            
                            <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload', $ids) }}">
                            @csrf 
        
                            </form>
                            <div></div>
                            <div align="center">
                                <a href="/banners/{{ $ids }}" class="btn btn-success">Refresh</a>
                            </div>
                        </div>
                        
                    </div>

                    @if(session()->has('message'))
                        <div class="d-flex justify-content-center align-items-baseline mt-5">
                            <div class="alert alert-success pt-3 m-0 col-3 text-center" role="alert">
                            {{ session()->get('message') }}
                            </div>
                        </div>
                    @endif

                    <div class="container mt-5">
                        @foreach ($companyBanners as $banner)
                            <div class="d-flex justify-content-center">

                                @if(  $banner->media->id == $company->profile->logo )
                                    <button class="mx-5 btn btn-warning p-0">Active</button>
                                @else
                                    <div id="test">
                                        <button id="btn" wire:click="select({{ $banner->id }})" class="mx-5 btn btn-success p-0"> Select </button>
                                    </div>
                                @endif

                                <button wire:click="delete({{ $banner->id }})" class="mx-5 btn btn-success p-0"> Delete </button>
                            </div>
                            <div class="d-flex justify-content-center mb-5">
                                <img class="m-3" src="{{ asset('storage/' . $banner->name) }}" alt="img" style="width:385px; height:265px;">
                                {{-- <video src="{{ asset('images/' . $banner->name) }}" style="width:109.83px; height:109.83px;"></video> --}}
                            </div>

                        @endforeach
                    </div>
                   
                    {{-- <div>
                        ...
                     
                        <div x-data="{ open: false }">
                            <button @click="open = true">Show More...</button>
                     
                            <ul x-show="open" @click.away="open = false">
                                <li><button wire:click="archive">Archive</button></li>
                                <li><button wire:click="delete">Delete</button></li>
                            </ul>
                        </div>
                    </div> --}}

                    <input type="text" id="datepicker">
 
                    <script>
                        new Pikaday({ field: document.getElementById('datepicker') })
                    </script>
                    {{-- @endif --}}

                    {{-- @if($showImage == true)
                        <input wire:model="image" class="dropzone" style="width: 50%" type="file" value="{{ old('logo') }}">
                        <div>
                            <button wire:click="store({{ $ids }})" class="btn btn-success mt-5"> Upload Photo </button>
                        </div>
                    @endif --}}

                    {{-- <div id="test">
                        <p>Hey There</p>
                    </div>

                    <button id="btn"> Click me

                    </button> --}}
                
                {{-- <x-date-picker
                wire:model="date"
                id="datepicker"
                autocomplete="off"/>


                <input id="datepicker"
                x-data
                x-ref="input"
                x-init="new Pikaday({ field: $refs.input, format: 'MM/DD/YYYY', minDate: new Date(),})"
                type="text"
                class="shadow-sm mt-1 focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md w-27rem"
            /> --}}

            {{-- <form wire:submit.prevent="schedule">
                <label for="title">Event Title</label>
                <input wire:model="title" id="title" type="text">
             
                <label for="date">Event Date</label>
                <x-date-picker wire:model="date" id="date"/>
             
                <button>Schedule Event</button>
            </form> --}}
            {{-- <div title="">
                <div id="color"></div>
                <input id="color-input" name="color" type="hidden" />
            </div>
            <input type="text" id="datepicker"> --}}
 
{{-- <script>
    new Pikaday({ field: document.getElementById('datepicker') })
</script> --}}
{{-- --}}
<x-color-picker name="color" /> 
<input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color"  value="{!! old('color') !!}" placeholder="Choose background color">
                </div>
            </div>
        </div>
    </div>
</div>

    {!! Html::script('/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') !!}
    {!! Html::script('/assets/plugins/cropperjs/cropper.min.js') !!}

<script>
    $(function () {
        // Basic instantiation:
        $('#color').colorpicker();

    });
</script>

<script>
    // $(document).ready(function () {
    //     $('#btn').click(function () {
    //         $('#test').text('Refresh')       
    //          });
    // });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>




