@if($showIndex == true)
    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="p-0">
                    <p>
                        <span class="text-success">{{ ucfirst($company->name) }}</span>
                            &nbsp; / &nbsp; 
                        <span class="text-dark">All Facilities</span>
                    </p>
                </a>
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
                                        <th class="text-center"> ID       </th>
                                        <th> &nbsp;&nbsp;&nbsp;  Name     </th>
                                        <th>                     Address  </th>

                                        @if ( $address == false)
                                            <th>                     City     </th>
                                            <th>                     State    </th>
                                            <th>                     Phone No </th>
                                            <th>                     Color    </th>
                                        @endif

                                        <th>&emsp;&nbsp;         Action   </th>
                                        
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
                                                @if (in_array($facility->id, $facilityIDS) || auth()->user()->hasRole('Platform Admin|Corporate Admin') )

                                                    <tr>    
                                                        <td class="text-center"> {{ $facility->id }}                            </td>
                                                        <th class="pt-1 pb-0 px-0">
                                                            <a href="{{ route('livewire.setting', $facility->id) }}" class="btn btn-link">{{ $facility->name }} </a>  
                                                        </th>
                                                        @if ( $facility->profile()->exists() )

                                                            @if ( $address == false)
                                                                <td>
                                                                    {{ ucfirst(substr($facility->Profile->address, 0, 10)) }}      
                                                                    @if( (strlen($facility->Profile->address)) > 10)
                                                                        <span>...
                                                                            <button wire:click="address" class="btn btn-link p-0"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                                                                            </button>
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            @else 
                                                                <td>
                                                                    {{ $facility->Profile->address }}
                                                                    @if( (strlen($facility->Profile->address)) > 10)
                                                                        <button  wire:click="address" class="btn btn-link p-0">
                                                                            &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                            
                                                            @if ( $address == false)
                                                                <td> {{ $facility->Profile->city }}                 </td>
                                                                <td> {{ $facility->Profile->state->name }}          </td>
                                                                <td> {{ $facility->Profile->phone }}                </td>

                                                                <td class="text-center">  
                                                                    <div class="progress ">
                                                                        <div class="progress-bar" role="progressbar" style="width: 100%;background-color: {!! $facility->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        @endif

                                                        <td class="no-gutters p-0">
                                                            @if ($facility->deleted_at == null)

                                                                <div class="d-flex justify-content-between"> 

                                                                    @if(auth()->user()->hasRole('Facility Editor'))
                                                                        <button class="btn btn-link mx-1" disabled>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                            Edit</button>
                                                                        <button class="btn btn-link mx-1 text-danger" disabled >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                            Delete</button>                                                       
                                                                    @else 
                                                                        <button wire:click="$emit('show', 'showEdit', {{ $facility->id }})" class="btn btn-link text-warning mx-1 ">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                            Edit</button>                                                                                       
                                                                        <button wire:click="destroy({{ $facility->id }})" class="btn btn-link text-danger mx-1" onclick="return confirm('Are you sure?')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                            Delete</button>
                                                                    @endif

                                                                </div>
                                                            @else

                                                            @if ( $address == false)
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            @endif
                                                                <td>
                                                                    <div>
                                                                        <button wire:click="restore({{ $facility->id }})" class="btn btn-link text-warning p-0 mx-3" onclick="return confirm('Are you sure?')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                                            Restore
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    
                                                @endif
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
