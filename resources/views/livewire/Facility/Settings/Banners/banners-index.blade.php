<div>
    @if($showIndex == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-5">Banners</h6>

                            <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                &nbsp;Add Banner&emsp;
                            </a>
                        </div>

                        <div class="row offset-1 col-sm-12">
                            @foreach ($banners as $banner)

                                <div class="card col-md-3 mx-3 border-success">
                                    {{ $banner->name }}

                                    @if ( $banner->media !== null )
                                        <img style="height:260px;width:260px;" src={{ asset('storage/'. $banner->media->url )}} alt="image">
                                    @endif
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showCreate == true)
        <div>
            <livewire:facility.settings.banners.banner-create :facility="$facilityID" />      
        </div>
    @endif

    @if($showEdit == true)
        <div>
            <livewire:facility.settings.banners.banner-edit :banner="$bannerID" />      
        </div>
    @endif

</div>


