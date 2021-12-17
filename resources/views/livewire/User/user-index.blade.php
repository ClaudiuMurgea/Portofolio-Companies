@if($showIndex == true)

    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
              <a class="navbar-brand text-success p-0">Users &nbsp; / &nbsp; All Users</a>
            </div>
        </nav>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h6 class="card-title mb-5">Users </h6>

                            @if(auth()->user()->hasAnyRole('Platform Admin|Regional Admin|Corporate Admin|Facility Admin'))  
                                <button wire:click="show('showCreate')" class="btn btn-success btn-sm mb-5" > Add User</button>
                            @endif         
                        </div>

                        <div class="d-flex justify-content-center">
                            <label for="Search">Search by name or email</label>
                        </div>         
                        <div class="d-flex justify-content-center">               
                            <div class="d-flex align-items-baseline col-3 justify-content-center">
                                <input type="text" wire:model="searchTerm" class="form-control">
                            </div>
                        </div>

                    </div>
                        
                        <div class="table table-responsive pt-3">       
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-success">
                                        <td class="text-center col-1">  ID          </td>
                                        <td class="text-center col-4">  Name        </td>
                                        <td class="text-center col-4">  Email       </td>
                                        <td class="text-center col-3">  Action      </td>
                                    </tr>
                                </thead>        
                        
                                <tbody>
                                    @if( auth()->user()->hasRole('Platform Admin')  ) 
                                        @foreach ( $users as $user)

                                            <tr class="table-success">
                                                <td class="text-center col-1">  {{ $user->id }}       </td>
                                                <td class="text-center col-4">  {{ $user->name }}     </td>
                                                <td class="text-center col-4">  {{ $user->email }}    </td>

                                                <td class="col-3">                       
                                                    <div class="d-flex justify-content-between">

                                                        <button wire:click="show('showEdit', {{ $user->id }})" class="btn btn-link p-0 mx-5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                            Edit
                                                        </button>
                                                        
                                                        <button wire:click="destroy({{ $user->id }})" class="btn btn-link p-0 mx-5 text-danger" onclick="return confirm('Are you sure?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                            Delete
                                                        </button>
                                                    
                                                    </div>     
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif
                                
                                    @if( auth()->user()->hasRole('Regional Admin') )
                                        @foreach( $users as $user )
                                            @if ( isset($user->permissions->first()->name)
                                            &&  ( $user->permissions->first()->name == auth()->user()->permissions->first()->name ) 
                                                )

                                                <tr class="table-success">
                                                    <td class="text-center col-1">  {{ $user->id }}       </td>
                                                    <td class="text-center col-4">  {{ $user->name }}     </td>
                                                    <td class="text-center col-4">  {{ $user->email }}    </td>            

                                                    <td class="col-3">
                                                        <div class="d-flex justify-content-between">

                                                            <button wire:click="show('showEdit', {{ $user->id }})" class="btn btn-link p-0 mx-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit
                                                            </button>
                                                            
                                                            <button wire:click="destroy({{ $user->id }})" class="btn btn-link p-0 mx-5 text-danger" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete
                                                            </button>

                                                        </div>   
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach
                                    @endif

                                    @if( auth()->user()->hasRole('Corporate Admin') )
                                        @foreach( $users as $user )
                                            @if  ( $user->roles->first()->name == 'Facility Admin' || $user->roles->first()->name == 'Facility Editor') 
                                                @if  ( in_array($user->id, $facilityUsers) )

                                                                                                
                                                    <tr class="table-success">
                                                        <td class="text-center col-1">  {{ $user->id }}       </td>
                                                        <td class="text-center col-4">  {{ $user->name }}     </td>
                                                        <td class="text-center col-4">  {{ $user->email }}    </td>            

                                                        <td class="col-3">
                                                            <div class="d-flex justify-content-between">

                                                                <button wire:click="show('showEdit', {{ $user->id }})" class="btn btn-link p-0 mx-5">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit
                                                                </button>
                                                                
                                                                <button wire:click="destroy({{ $user->id }})" class="btn btn-link p-0 mx-5 text-danger" onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    Delete
                                                                </button>

                                                            </div>
                                                        </td>
                                                    </tr>

                                                @endif                           
                                            @endif
                                        @endforeach 
                                    @endif

                                    @if(auth()->user()->hasRole('Facility Admin'))
                                    @foreach( $users as $user)
                                        @if ( isset($user->permissions->first()->name)
                                        && ( $user->permissions->first()->name == auth()->user()->permissions->first()->name 
                                        &&   $user->hasRole( 'Facility Editor' ) ) 
                                            )
                                        
                                            <tr class="table-success">
                                                <td class="text-center col-1">  {{ $user->id }}       </td>
                                                <td class="text-center col-2">  {{ $user->name }}     </td>
                                                <td class="text-center col-6">  {{ $user->email }}    </td>            

                                                <td class="no-gutters p-0 col-3">
                                                    <table class="table table-borderless no-gutters">
                                                        <div class="d-flex justify-content-between">

                                                            <button wire:click="show('showEdit', {{ $user->id }})" class="btn btn-link p-0 mx-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit
                                                            </button>
                                                            
                                                            <button wire:click="destroy({{ $user->id }})" class="btn btn-link p-0 mx-5 text-danger" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete
                                                            </button>

                                                        </div>
                                                    </table>       
                                                </td>
                                            </tr>

                                        @endif
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                           
                        </div>
                        {{ $users->links('layouts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endif

@if($showCreate == true)
    <div>
        <livewire:user.user-create/>      
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:user.user-edit :userID="$ids"/>
    </div>
@endif
