<div class="position-absolute start-0 w-100">
    
    @if($active == true)
        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="navbar-brand text-success p-0">Users &nbsp; / &nbsp; Edit User</a>
                <a wire:click="back" class="navbar-brand btn btn-success text-white col-md-1 p-0 d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-center mb-5">User Details</h6>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="edit_name">Full Name</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_name" required>
                                    
                                    @error('edit_name')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="edit_email">Email</label>
                                    <input class="form-control" type="email" wire:model.defer="edit_email" required>
                                    
                                    @error('edit_email')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" wire:model.defer="password" placeholder="Old password...">
                                    
                                    @error('password')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror
                            
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="role">Role</label>
                                    <select class="form-control text-success" wire:model="role" required>

                                        <option value="">Select Role</option>
                                        
                                        @if(auth()->user()->hasRole('Platform Admin'))
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option> 
                                            @endforeach
                                        @endif

                                        @if(auth()->user()->hasRole('Regional Admin'))
                                            @foreach($regionalCanMakeRoles as $regionalRole)
                                                <option value="{{ $regionalRole->id }}">{{ $regionalRole->name }}</option>
                                            @endforeach
                                        @endif

                                        @if(auth()->user()->hasRole('Corporate Admin'))
                                            @foreach($corporateCanMakeRoles as $corporateRole)
                                                <option value="{{ $corporateRole->id }}">{{ $corporateRole->name }}</option>
                                            @endforeach
                                        @endif

                                        @if(auth()->user()->hasRole('Facility Admin'))
                                            @foreach($facilityCanMakeRoles as $facilityRole)
                                                <option value="{{ $facilityRole->id }}">{{ $facilityRole->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>          

                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        @if($Regional_Admin == true)
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-4 mt-2">

                                        <label for="role">Region</label>
                                        <select class="form-control text-success" wire:model.defer="region" multiple>

                                            @foreach ($regions as $region)
                                                @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin'))
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="text-muted pt-1 text-center">Press CTRL to select multiple values. </p>

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($Corporate_Admin == true )
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-4 mt-2">

                                        <label for="company">Company</label>
                                        <select class="form-control text-success" wire:model.defer="company" size=3>

                                            @foreach ($companies as $company)
                                                    <option value="{{ $company->id}}" >{{ $company->name }}</option>
                                            @endforeach

                                        </select>
                                        <p class="text-muted pt-1 text-center">Select one company. </p>

                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($Facility_Admin == true || $Facility_Editor == true)
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="facility">Facility</label>
                                    <select class="form-control text-success" wire:model.defer="facility" multiple>

                                        @foreach ($facilities as $facility)
                                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted pt-1 text-center">Press CTRL to select multiple values. </p>
                                    
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-2 mt-2 mb-5">
                                    <button wire:click="update({{ $ids }})" class="btn btn-success form-control">Submit </button>
                                </div>
                            </div>
                        </div>

                        <div class="position-absolute bottom-40 end-50">
                            <i wire:loading wire:target="update({{ $ids }})" class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($return == true)
        <div>
            <livewire:user.user-index/>        
        </div>
    @endif
</div>


