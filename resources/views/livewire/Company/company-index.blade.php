@if($showIndex == true)
    @section( 'title', 'HC Dash' )
    
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
                                <div class="d-flex align-items-baseline col-2 justify-content-center">
                                    <input type="text" wire:model="searchTerm" class="form-control">
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive pt-5 pb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">  ID       </th>
                                        <th scope="col">                      Name     </th>
                                        <th scope="col">                      Address  </th>
                                        <th scope="col">                      City     </th>
                                        <th scope="col">                      State    </th>
                                        <th scope="col">                      Phone No </th>
                                        <th scope="col">                      Color    </th>
                                        <th scope="col">&emsp;                Actions  </th>
                                    </tr>
                                </thead>        
                                <tbody>
                                    @if( auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
                                        @if($companies->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center text-success">
                                                    There are no companies defined!
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ( $companies as $company)                 
                                                <tr>        
                                                    <td class="text-center">  {{ $company->id }}        </td>
                                                    <th>                      {{ $company->name }}      </th>
                                                    
                                                    @if ( $company->profile()->exists() )
                                                        <td>  {{ $company->Profile->address }}          </td>
                                                        <td>  {{ $company->Profile->city }}             </td>
                                                        <td>  {{ $company->Profile->state->short_name }}</td>
                                                        <td>  {{ $company->Profile->phone }}            </td>
                                                        
                                                        <td>  
                                                            <div class="progress">
                                                            <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $company->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                            </div>
                                                        </td>
                                                    @endif
                                                
                                                    <td class="no-gutters p-0">                 
                                                        @if ($company->deleted_at == null)
                                                            <button wire:click="show('showFacilities', {{ $company->id }})" class="btn btn-link text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                                                                Facilities
                                                            </button>

                                                            <a href="{{ route('livewire.banner', $company->id) }}" class="btn btn-link text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path><polyline points="8 10 12 14 16 10"></polyline></svg>
                                                                Banners
                                                            </a>

                                                            <button wire:click="show('showAnnouncements', {{ $company->id }})" class="btn btn-link text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                                                                Announcements
                                                            </button>

                                                            <button wire:click="settings" class="btn btn-link p-0 text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity text-primary"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                            </button>

                                                            @if ($settings == true)
                                                            <br/>
                                                                <div>
                                                                    <button wire:click="show('createSettings', {{ $company->id }})" class="btn btn-link p-0 text-primary mx-3">
                                                                        &nbsp;&nbsp;
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity text-primary"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                                                        Settings
                                                                    </button>

                                                                    <button wire:click="show('showEdit', {{ $company->id }})" class="btn btn-link p-0 text-warning mx-5">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                        Edit
                                                                    </button>

                                                                    <button wire:click.defer="destroy({{ $company->id }})" class="btn btn-link p-0 text-danger mx-4" onclick="return confirm('Are you sure?')">
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                        Delete
                                                                    </button>
                                                                </div>
                                                            @endif
                                                    
                                                        @else 
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <div>
                                                                    <button wire:click="restore({{ $company->id }})" class="btn btn-link text-warning p-0 mx-3" onclick="return confirm('Are you sure?')">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                                        Restore
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    
                                    @if( auth()->user()->hasAnyRole('Corporate Admin|Facility Admin|Facility Editor') ) 
                                        @if($userCompany->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center text-success">
                                                    There are no companies defined!
                                                </td>
                                            </tr>
                                        @else 
                                            @foreach ($userCompany as $company)
                                                <tr>   
                                                    <td class="text-center">  {{ $company->id }}        </td>
                                                    <td>                      {{ $company->name }}      </td>

                                                    @if ( $company->profile()->exists() )
                                                        <td>  {{ $company->Profile->address }}          </td>
                                                        <td>  {{ $company->Profile->city }}             </td>
                                                        <td>  {{ $company->Profile->state->short_name }}</td>
                                                        <td>  {{ $company->Profile->phone }}            </td>
                                                        
                                                        <td>  
                                                            <div class="progress">
                                                            <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $company->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                            </div>
                                                        </td>
                                                    @endif
                                                
                                                    <td class="no-gutters p-0">                 
                                                        @if ($company->deleted_at == null)
                                                            <button wire:click="show('showFacilities', {{ $company->id }})" class="btn btn-link text-success" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                                                                Facilities
                                                            </button>

                                                            <a href="{{ route('livewire.banner', $company->id) }}" class="btn btn-link text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 3h16a2 2 0 0 1 2 2v6a10 10 0 0 1-10 10A10 10 0 0 1 2 11V5a2 2 0 0 1 2-2z"></path><polyline points="8 10 12 14 16 10"></polyline></svg>
                                                                Banners
                                                            </a>

                                                            <button wire:click="show('showAnnouncements', {{ $company->id }})" class="btn btn-link text-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>
                                                                Announcements
                                                            </button>

                                                            @if( auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )  
                                                                <button class="btn btn-link p-0 text-warning mx-4" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit
                                                                </button>
                                                            @else  
                                                                <button wire:click="show('showEdit', {{ $company->id }})" class="btn btn-link p-0 text-warning mx-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit
                                                                </button>
                                                            @endif

                                                            <button class="btn btn-link p-0 text-danger mx-4" disabled>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                Delete
                                                            </button>

                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
        <livewire:company.company-edit :company="$ids"/>
    </div>
@endif

@if($showFacilities == true)
    <div>
        <livewire:facility.facility-index :company="$ids"/>
    </div>
@endif

@if($showBanners == true)
    <div>
        <livewire:company.settings.banners.banner-component :company="$ids"/>
    </div>
@endif

@if($showAnnouncements == true)
    <div>
        <livewire:company.settings.announcements.company-announcements-index :company="$ids"/>
    </div>
@endif

@if($createSettings == true)
    <div>
        <livewire:company.settings.settings-component :company="$ids"/>
    </div>
@endif