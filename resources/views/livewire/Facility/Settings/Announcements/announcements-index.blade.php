<div>
    @if($showIndex == true)
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-5">Announcements</h6>
                            
                            <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                &nbsp;Add Announcement&emsp;
                            </a>
                        </div>
                        @if($announcements->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-success">
                                    There are no announcements!
                                </td>
                            </tr>
                        @else

                            @foreach ($announcements as $announcement)
                                <div class="container-fluid p-0">
                                    <div class="row starter-main p-0">
                                
                                        <div class="col-sm-12 grid-margin stretch-card mt-5">
                                            <div class="card border-success">

                                                <div class="card-body d-flex justify-content-center p-0">
                                                    <h5>{{ ucfirst($announcement->title) }}</h5> 
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="text-success"> ({{ $announcement->start_at }} / {{ $announcement->end_at }}) </p>
                                                    </div>
                                                    <div>
                                                        <button wire:click="edit({{ $announcement->id }})" class="btn btn-link p-0 text-warning mx-5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-md text-warning editIcon" data-toggle="modal" data-target="#display-modal" data-displayid="1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                        </button>
                                                        <button wire:click="delete({{ $announcement->id }})" class="btn btn-link p-0 text-danger mx-5" onclick="return confirm('Are you sure?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <p>
                                                    {{ ucfirst($announcement->announcement) }}
                                                    </p>
                                                </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showCreate == true)
        <div>
            <livewire:facility.settings.announcements.announcement-create :facility="$facilityID" />      
        </div>
    @endif

    @if($showEdit == true)
        <div>
            <livewire:facility.settings.announcements.announcement-edit :announcement="$announcementID" />      
        </div>
    @endif

</div>



