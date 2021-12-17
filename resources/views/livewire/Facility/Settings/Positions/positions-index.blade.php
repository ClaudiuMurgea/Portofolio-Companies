<div>
    @if($showIndex == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-5">Positions</h6>

                            <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                &nbsp;Add Position&emsp;
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
  
    @if($showCreate == true)
        <div>
            <livewire:facility.settings.positions.position-create :facility="$facilityID" />      
        </div>
    @endif

</div>
