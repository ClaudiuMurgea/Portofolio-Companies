<div>

    @if($active == true)
        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="navbar-brand text-success  p-0">{{ ucfirst($company->name) }} &nbsp; / &nbsp;&nbsp;Banners &nbsp; </a>
                <a wire:click="back" class="navbar-brand btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title mb-5 text-center"> Company Banners</h5>
                            </div>
            
                            <div class="panel-body">
                                
                                <form wire:ignore id="dropzoneForm" class="dropzone border-success" action="{{ route('dropzone.upload', $ids) }}">
                                @csrf
                                    <div class="d-flex justify-content-center">
                                        <i class="icon-cloud-up text-success"></i>
                                    </div>
                                </form>
                                <div></div>
                                <div align="center">
                                    <a href="{{ route('livewire.banner', $ids) }}" class="btn btn-success">Refresh</a>
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

                                    <button wire:click="delete({{ $banner->id }})" class="mx-5 btn btn-danger p-0"> Delete </button>
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
    @endif
    
    @if($return == true)
        <div>
            <livewire:company.company-index/>        
        </div>
    @endif
</div>









