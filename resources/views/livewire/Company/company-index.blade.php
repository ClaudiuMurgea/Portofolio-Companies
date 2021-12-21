@if($showIndex == true)
    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
              <a class="navbar-brand text-success p-0">Companies &nbsp; / &nbsp; All Companies</a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <h6 class="card-title mb-5 pl-2">Companies</h6>
                            
                            @if( auth()->user()->hasAnyRole('Corporate Admin|Facility Admin|Facility Editor') )
                                <a class="btn btn-success mb-5 p-0 d-flex justify-content-center" onclick="return confirm('You cannot add companies!')">&emsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Company&emsp;
                                </a>   
                            @else  
                                <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Company&emsp;
                                </a>
                            @endif 
                            
                        </div> 
                    @if(auth()->user()->hasAnyRole('Platform Admin|Regional Admin'))
                        <div class="d-flex justify-content-center">
                            <label for="Search">Find company by name</label>
                        </div>  
                        <div class="d-flex justify-content-center">               
                            <div class="d-flex align-items-baseline col-3 justify-content-center">
                                <input type="text" wire:model="searchTerm" class="form-control">
                            </div>
                        </div>
                    @endif

                        @if($showDetails == true)

                        <div class="d-flex justify-content-center mt-5">
                            <h4> {{ $companyDetails->name }}</h4>
                        </div>


                        <div class="mt-2 mb-2">                                                                               
                            
                            <div class="d-flex justify-content-center">
                                @if ( $companyDetails->profile->media() !== null )
                                    <img src={{ asset('storage/'. $companyDetails->Profile->media->url)}} alt="image">
                                @endif
                            </div>

                            <div class="d-flex justify-content-center">
                                ID :    {{ $companyDetails->id }}
                            </div>

                            <div class="d-flex justify-content-center">
                                State :    {{ $companyDetails->Profile->state->name }}
                            </div>

                            <div class="d-flex justify-content-center">
                                City :     {{ $companyDetails->Profile->city }}             
                            </div> 

                            <div class="d-flex justify-content-center">
                                Address :  {{ $companyDetails->Profile->address }}
                            </div>
                        
                            <div class="d-flex justify-content-center">
                                Phone :    {{ $companyDetails->Profile->phone }}            
                            </div>    

                            
                        <div class="progress col-2 offset-5">
                            <div class="progress-bar" role="progressbar" style="width: 100%; background-color: {!! $companyDetails->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                        </div>
                            
                        </div> 
                    @endif

                        <div class="table table-responsive pt-3">
                            <table class="table table-bordered">

                                <thead>
                                    <tr class="table-success">
                                        {{-- <td class="text-center col-1">  ID       </td> --}}
                                        <th class="text-center col-4">  Name     </th>
                                        {{-- <td class="text-center col-1">  Address  </td> --}}
                                        {{-- <td class="text-center col-1">  City     </td> --}}
                                        {{-- <td class="text-center col-1">  State    </td> --}}
                                        {{-- <td class="text-center col-1">  Phone No </td> --}}
                                        {{-- <td class="text-center col-1">  Color    </td> --}}
                                        <th class="text-center col-8">  Action   </th>
                                    </tr>
                                </thead>        
                        
                                <tbody>
                                    @if( auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
                                        @foreach ( $companies as $company)                 
                                            <tr class="table-success">        
                                                {{-- <td class="text-center col-1">  {{ $company->id }}                        </td> --}}
                                                <td class="text-center col-4">  {{ $company->name }}                      </td>
                                                {{-- <td class="text-center col-1">  {{ $company->Profile->address }}          </td> --}}
                                                {{-- <td class="text-center col-1">  {{ $company->Profile->city }}             </td> --}}
                                                {{-- <td class="text-center col-1">  {{ $company->Profile->state->short_name }}</td> --}}
                                                {{-- <td class="text-center col-1">  {{ $company->Profile->phone }}            </td> --}}
                                                
                                                {{-- <td class="col-1">  
                                                    <div class="progress">
                                                    <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $company->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                    </div>
                                                </td> --}}
                                            
                                                <td class="no-gutters p-0 col-8">                 
                                                    <table class="table table-borderless no-gutters">
                                                        <div class="d-flex justify-content-between"> 

                                                            @if ($company->deleted_at == null)
                                                                <a class="btn btn-link text-success mx-2" href="{{ route('livewire.facility', $company->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                                                                    Facilities
                                                                </a>

                                                                <a class="btn btn-link text-success mx-2" href="{{ route('livewire.banner', $company->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path><polyline points="8 10 12 14 16 10"></polyline></svg>
                                                                    Banners
                                                                </a>

                                                                <a class="btn btn-link  text-success mx-2" href="{{ route('livewire.facility', $company->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                                                                    Announcements
                                                                </a>

                                                                <a class="btn btn-link  text-info  mx-3" wire:click="details({{ $company->id }})">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                                                    Details
                                                                </a>
                                                            
                                                                <button wire:click="show('showEdit', {{ $company->id }})" class="btn btn-link p-0 text-warning mx-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit
                                                                </button>

                                                                <button wire:click="destroy({{ $company->id }})" class="btn btn-link p-0 text-danger mx-4" onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    Delete
                                                                </button>

                                                            @else 
                                                            <div class="offset-5">
                                                                <button wire:click="restore({{ $company->id }})" class="btn btn-link text-warning" onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                                    &nbsp;Restore
                                                                </button>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </table>      
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                    @if( auth()->user()->hasAnyRole('Corporate Admin|Facility Admin|Facility Editor') )                                                                                                 
                                        <tr class="table-success">   
                                            {{-- <td class="text-center col-1">  {{ $userCompany->id }}                        </td> --}}
                                            <td class="text-center col-4">  {{ $userCompany->name }}                      </td>
                                            {{-- <td class="text-center col-1">  {{ $userCompany->Profile->address }}          </td> --}}
                                            {{-- <td class="text-center col-1">  {{ $userCompany->Profile->city }}             </td> --}}
                                            {{-- <td class="text-center col-1">  {{ $userCompany->Profile->state->short_name }}</td> --}}
                                            {{-- <td class="text-center col-1">  {{ $userCompany->Profile->phone }}            </td> --}}
                                            
                                            {{-- <td class="col-1">  
                                                <div class="progress">
                                                <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $userCompany->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                </div>
                                            </td> --}}
                                        
                                            <td class="no-gutters p-0 col-8 p-0">                 
                                                <table class="table table-borderless no-gutters">
                                                    <div class="d-flex justify-content-between"> 
                                                                                                         
                                                        <a class="mx-5 btn btn-link text-success" href="{{ route('livewire.facility', $userCompany->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                                                            Facilities
                                                        </a>

                                                        <a class="mx-2 btn btn-link text-success" href="{{ route('livewire.facility', $userCompany->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path><polyline points="8 10 12 14 16 10"></polyline></svg>
                                                            Banners
                                                        </a>

                                                        <a class="mx-2 btn btn-link  text-success" href="{{ route('livewire.facility', $userCompany->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                                                            Announcements
                                                        </a>

                                                        <a class="mx-2 btn btn-link  text-info" wire:click="details({{ $userCompany->id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                                            Details
                                                        </a>

                                                       
                                                        @if( auth()->user()->hasRole('Corporate Admin') )
                                                            <button wire:click="$emit('show', 'showEdit', {{ $userCompany->id }})" class="btn btn-link mx-2 p-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit
                                                            </button>

                                                            <button wire:click="destroy({{ $userCompany->id }})" class="btn btn-link mx-2 p-0 text-danger" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete
                                                            </button>
                                                        
                                                        @endif
                                                    </div>
                                                </table>      
                                            </td>
                                            
                                        </tr>
                                    @endif           
                                </tbody>

                            </table>
                            @if( auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
                                {{ $companies->links('layouts.pagination') }}
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div> 
        </div>

    </div>

@endif

@if($showCreate == true)
    <div>
        <livewire:company.company-create/>      
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:company.company-edit :companyID="$ids"/>
    </div>
@endif

{{-- <script>
    feather.replace()
</script> --}}