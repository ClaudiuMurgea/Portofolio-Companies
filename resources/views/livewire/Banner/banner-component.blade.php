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
 
                </div>
            </div>
        </div>
    </div>
</div>









