<div>
    @if ($showIndex == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-4">Displays</h6>

                            <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                &nbsp;Add Display&emsp;
                            </a>
                        </div>
                    </div>

                    <div class="row offset-1 col-sm-12">
                        @foreach ($displays as $display)
                            <div class="card col-md-3 mx-3 border-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor mr-1 icon-md text-success" style="margin-left:10%;width: 80%;height: 200px"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                                
                                <div class="card-body displayDetails">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">  {{ $display->name }}  </h5>

                                        <button wire:click="show('showEdit', {{ $display->id }})" class="border-white bg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-md text-warning editIcon" data-toggle="modal" data-target="#display-modal" data-displayid="1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </button>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="card-text">Identifier: </p>
                                        <strong>{{ $display->identifier }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="card-text">Type: </p>
                                        <strong>{{ $display->display_type }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="card-text">Orientation: </p>
                                        <strong> @if($display->horizontal == 1)Horizontal @else Vertical @endif </strong>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="card-text display text-danger displayOnlineStatus_1" style="font-weight:bold;">
                                            @if($display->status == 1) Online @else Offline @endif</p><br>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        {{-- <label class="switch pr-5 switch-primary mr-3"><span></span>
                                            <input class="status" data-monitorid="1" type="checkbox"><span class="slider"></span>
                                        </label> --}}
                                        <label class="switch">Toggle Fails
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>

                                        <button wire:click="delete({{ $display->id }})" class="border-white bg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-1 icon-md text-danger remove" onclick="removeMonitor(1,false)"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </div>

                                

                                    {{--    <p class="card-text">Status</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="switch pr-5 switch-primary mr-3"><span></span>
                                                <input class="status" data-monitorid="1" type="checkbox"><span class="slider"></span>
                                                </label>
                                            </div> --}}
                                                        
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    @if($showCreate == true)
        <div>
            <livewire:facility.settings.displays.display-create :facility="$facilityID" />      
        </div>
    @endif

    @if($showEdit == true)
        <div>
            <livewire:facility.settings.displays.display-edit :facility="$facilityID" />      
        </div>
    @endif
    
</div>
