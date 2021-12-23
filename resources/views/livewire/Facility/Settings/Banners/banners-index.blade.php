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

                        @if($banners->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-success">
                                    There are no banners defined!
                                </td>
                            </tr>
                        @else
                            <div class="row offset-1">
                                @foreach ($banners as $banner)

                                    <div class="card col-md-3 mx-4 my-4 border-success">
                                        <div class="text-center pb-2 pt-2">
                                            {{ $banner->name }}
                                        </div>

                                        <div class="d-flex justify-content-center pb-2">
                                            @if ( $banner->media !== null )
                                                <img style="height:260px;width:260px;" src={{ asset('storage/'. $banner->media->url )}} alt="image">
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-between pb-1">
                                            <button wire:click="edit({{ $banner->id }})" class="btn btn-link p-0 text-warning mx-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-md text-warning editIcon" data-toggle="modal" data-target="#display-modal" data-displayid="1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                {{-- edit --}}
                                            </button>

                                            <button wire:click="delete({{ $banner->id }})" class="btn btn-link p-0 text-danger mx-5" onclick="return confirm('Are you sure?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                {{-- delete --}}
                                            </button>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        @endif

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


