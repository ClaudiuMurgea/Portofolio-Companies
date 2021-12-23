@if($showIndex == true)
    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="navbar-brand text-success p-0">{{ ucfirst($company->name) }} &nbsp; / &nbsp; All Facilities</a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-5">Facilities</h6>
                            @if(!auth()->user()->hasRole('Facility Editor'))
                                <a wire:click="show('showCreate', {{ $ids }})" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Facility&nbsp;&emsp;
                                </a>
                            @else
                                <a class="btn btn-success mb-5 p-0 d-flex justify-content-center" onclick="return confirm('You cannot add faclities!')">&emsp;&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Facility&nbsp;&emsp;
                                </a>
                            @endif
                       
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <label for="Search">Find facility by name</label>
                        </div>  
                        <div class="d-flex justify-content-center">               
                            <div class="d-flex align-items-baseline col-2 justify-content-center">
                                <input type="text" wire:model="searchTerm" class="form-control">
                            </div>
                        </div>

                        <div class="table-responsive pt-5 pb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"> ID        </th>
                                        <th> &nbsp;&nbsp;&nbsp;  Name      </th>
                                        <th> Address   </th>
                                        <th> City      </th>
                                        <th> State     </th>
                                        <th> Phone No  </th>
                                        <th> Color     </th>
                                        <th class="text-center"> Action    </th>
                                    </tr>
                                </thead>        
                            
                                <tbody>
                                    @if($facilities->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center text-success">
                                                There are no facilities defined!
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ( $facilities as $facility)
                                            @if ( auth()->user()->can($facility->permissions->name) || auth()->user()->hasRole('Platform Admin|Corporate Admin') )
                                                <tr>        
                                                    <td class="text-center"> {{ $facility->id }}                            </td>
                                                    <th class="pt-1 pb-0 px-0">
                                                        <a href="{{ route('livewire.setting', $facility->id) }}" class="btn btn-link">{{ $facility->name }} </a>  
                                                    </th>
                                                    <td> {{ $facility->Profile->address }}              </td>
                                                    <td> {{ $facility->Profile->city }}                 </td>
                                                    <td> {{ $facility->Profile->state->name }}          </td>
                                                    <td> {{ $facility->Profile->phone }}                </td>

                                                    <td class="text-center">  
                                                        <div class="progress ">
                                                            <div class="progress-bar" role="progressbar" style="width: 100%;background-color: {!! $facility->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>

                                                    <td class="p-0">
                                                        <div class="d-flex justify-content-center"> 

                                                            @if(auth()->user()->hasRole('Facility Editor'))
                                                                <button class="btn btn-link mx-5" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit</button>
                                                                <button class="btn btn-link mx-5 text-danger" disabled >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    Delete</button>                                                       
                                                            @else 
                                                                <button wire:click="$emit('show', 'showEdit', {{ $facility->id }})" class="btn btn-link text-warning mx-4 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit</button>                                                                                       
                                                                <button wire:click="destroy({{ $facility->id }})" class="btn btn-link text-danger mx-4" onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                    Delete</button>
                                                            @endif

                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endif

@if($showCreate == true)
    <div>
        <livewire:facility.facility-create :company="$ids">
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:facility.facility-edit :facilityID="$ids">
    </div>
@endif
