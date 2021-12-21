<div>
    @if($showIndex == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-5">Positions</h5>

                            <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                &nbsp;Add Position&emsp;
                            </a>
                        </div>

                        @foreach ($positions as $position)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
            
                                    <div class="d-flex justify-content-between">
                                        <div class="offset-1">
                                            <h5 class="mx-5">{{ ucfirst($position->name) }}</h5>
                                            <article class="mx-5">{!! $position->description !!}</article>  
                                            <br>
                                            <div class="d-flex justify-content-center">
                                                
                                                {{-- <button wire:click="" class="btn btn-link p-0 text-warning mx-4">
                                                    <button wire:click="destroy({{ $company->id }})" class="btn btn-link p-0 text-danger mx-4" onclick="return confirm('Are you sure?')"> --}}
                                                        {{-- show('showEdit', {{ $company->id }}) --}}

                                                <button wire:click="edit({{ $position->id }})" class="btn btn-link p-0 text-warning mx-5 border-warning bg-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                    {{-- edit --}}
                                                </button>

                                                <button wire:click="delete({{ $position->id }})" class="btn btn-link p-0 text-danger mx-5 border-danger bg-white" onclick="return confirm('Are you sure?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-1 icon-md text-danger remove" onclick="removeMonitor(1,false)"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

                                                    {{-- delete --}}
                                                </button>
                                            </div>
                                        </div>
            
                                        <div>
                                            <img  style="width: 180px;" src="{{ url('/assets/images/positions/'. $position->pos_image) }}" alt="img">
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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

    @if($showEdit == true)
        <div>
            <livewire:facility.settings.positions.position-edit :position="$positionID" />      
        </div>
    @endif

</div>
