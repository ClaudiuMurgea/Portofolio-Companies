<div>
    @if($showIndex == true)

    <nav class="navbar navbar-light p-0">
        <div class="container-fluid">
          <a class="navbar-brand text-success p-0">{{ ucfirst($company->name) }} &nbsp; / &nbsp; Company Wide Announcements</a>
        </div>
    </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-5">Announcements</h6>
                            
                            @if( auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )  
                                <a class="btn btn-success mb-5 p-0 d-flex justify-content-center" onclick="return confirm('You cannot add announcements!')">&emsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Announcement&emsp;
                                </a>
                            @else
                                <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Announcement&emsp;
                                </a>
                            @endif
                        </div>
                        @if($announcements->isEmpty())
                                <p class="text-center text-success">
                                    There are no announcements!
                                </p>
                        @else
                            @foreach ($announcements as $announcement)
                                <div class="container-fluid p-0">
                                    <div class="row starter-main p-0">
                                
                                        <div class="col-sm-12 grid-margin stretch-card mt-5">
                                            <div class="card border-success">

                                                <div class="card-body d-flex justify-content-between p-0">
                                                    <div>
                                                        <h5> &emsp;&emsp;{{ ucfirst($announcement->title) }}</h5> 
                                                    </div>

                                                    <div>
                                                        @if( !auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )  
                                                            <button wire:click="edit({{ $announcement->id }})" class="btn btn-link p-0 text-warning mx-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                            </button>
                                                            <button wire:click="delete({{ $announcement->id }})" class="btn btn-link p-0 text-danger mx-5" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p> &emsp;&emsp;&emsp;{!! ucfirst($announcement->announcement) !!} </p>
                                                    </div>

                                                    <div>
                                                        <p class="text-success"> ({{ $announcement->start_at }} / {{ $announcement->end_at }}) </p>
                                                    </div>
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
            <livewire:company.settings.announcements.company-announcement-create :company="$company->id" />      
        </div>
    @endif

    @if($showEdit == true)
        <div>
            <livewire:company.settings.announcements.company-announcement-edit :announcement="$announcementID" />      
        </div>
    @endif

</div>
