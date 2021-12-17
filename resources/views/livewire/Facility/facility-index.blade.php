@if($showIndex == true)
    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="navbar-brand text-success p-0">Facilities &nbsp; / &nbsp; All Facilities</a>
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
                            <div class="d-flex align-items-baseline col-3 justify-content-center">
                                <input type="text" wire:model="searchTerm" class="form-control">
                            </div>
                        </div>

                        @if($showDetails == true)

                            <div class="d-flex justify-content-center mt-5">
                                <h4> {{ $facilityDetails->name }}</h4>
                            </div>

                            <div class="d-flex justify-content-center">
                                @if ( $facilityDetails->profile->media->url )
                                    <img src={{ asset('storage/'. $facilityDetails->Profile->media->url)}} class="imgs" alt="image">
                                @endif
                            </div>

                            <div class="mt-2 mb-2">                                                                               

                                <div class="d-flex justify-content-center">
                                    ID :    {{ $facilityDetails->id }}
                                </div>

                                <div class="d-flex justify-content-center">
                                    State :    {{ $facilityDetails->Profile->state->name }}
                                </div>

                                <div class="d-flex justify-content-center">
                                    City :     {{ $facilityDetails->Profile->city }}             
                                </div> 

                                <div class="d-flex justify-content-center">
                                    Address :  {{ $facilityDetails->Profile->address }}
                                </div>
                            
                                <div class="d-flex justify-content-center">
                                    Phone :    {{ $facilityDetails->Profile->phone }}            
                                </div>               
                                
                            </div> 
                        @endif

                        <div class="table table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-success">
                                        {{-- <td class="text-center col-1"> ID        </td> --}}
                                        <th class="text-center col-4">   Name      </th>
                                        {{-- <td class="text-center col-2"> Address   </td> --}}
                                        {{-- <td class="text-center col-1"> City      </td> --}}
                                        {{-- <td class="text-center col-1"> State     </td> --}}
                                        {{-- <td class="text-center col-1"> Phone No  </td> --}}
                                        {{-- <td class="text-center col-1"> Color     </td> --}}
                                        <th class="text-center col-8">   Action     </th>
                                    </tr>
                                </thead>        
                            
                                <tbody>
                                    @foreach ( $facilities as $facility)
                                        @if ( auth()->user()->can($facility->permissions->name) || auth()->user()->hasRole('Platform Admin||Regional Admin||Corporate Admin') )
                                            <tr class="table-success">        
                                                {{-- <td class="text-center col-1"> {{ $facility->id }}                            </td> --}}
                                                <td class="text-center col-4 pt-1 pb-0">
                                                    <a href="{{ route('livewire.setting', $facility->id) }}" class="btn btn-link">{{ $facility->name }} </a>  
                                                </td>
                                                {{-- <td class="text-center col-2"> {{ $facility->Profile->address }}              </td> --}}
                                                {{-- <td class="text-center col-1"> {{ $facility->Profile->city }}                 </td> --}}
                                                {{-- <td class="text-center col-1"> {{ $facility->Profile->state->name }}          </td> --}}
                                                {{-- <td class="text-center col-1"> {{ $facility->Profile->phone }}                </td> --}}

                                                {{-- <td class="text-center col-1">  
                                                    <div class="progress ">
                                                        <div class="progress-bar" role="progressbar" style="width: 100%;background-color: {!! $facility->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td> --}}

                                                <td class="p-0 col-8 p-0">
                                                    <div class="d-flex justify-content-between"> 

                                                        <div></div>
                                                        
                                                        <a class="btn btn-link  text-info" wire:click="details({{ $facility->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                                            Details
                                                        </a>
                                                    
                                                        @if(auth()->user()->hasRole('Facility Editor'))
                                                            <button class="btn btn-link mx-5 p-0" disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit</button>
                                                            <button class="btn btn-link mx-5 p-0 text-danger" disabled >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete</button>                                                       
                                                        @else 
                                                            <button wire:click="$emit('show', 'showEdit', {{ $facility->id }})" class="btn btn-link p-0 mx-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit</button>                                                                                       
                                                            <button wire:click="destroy({{ $facility->id }})" class="btn btn-link text-danger p-0 mx-4" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete</button>
                                                        @endif

                                                        <div></div>

                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endif
                                    @endforeach
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
        <livewire:facility.facility-create :companyID="$company->id">
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:facility.facility-edit :facilityID="$ids">
    </div>
@endif
