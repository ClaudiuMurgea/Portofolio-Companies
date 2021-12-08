<div class="position-absolute start-0 w-100">

    <div class="d-flex">
        <span> <a href="{{ route('livewire.region') }}">&emsp; Users &nbsp;</a>            </span>
        <span> &emsp; / &emsp; Create User                                                 </span>
        <span class="offset-9 ml-5">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
           <a class="btn btn-sm btn-primary" href="/users">Back</a>                        </span>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title mb-4 text-center">User Details</h6>

                    <form wire:submit.prevent="create">
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="name">Full Name</label>
                                    <input class="form-control" type="text" wire:model.defer="name" required>
                                    
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" wire:model.defer="email" required>
                                    
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" wire:model.defer="password" required>
                                    
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="role">Role</label>
                                    <select class="form-control text-center text-success" wire:model="role" required>

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

                        @if( $Regional_Admin == true)
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-4 mt-2">

                                        <label for="role">Region</label>
                                        <select class="form-control text-center text-success" wire:model.defer="region" multiple>

                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
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
                                        <select class="form-control text-center text-success font-weight-bold" wire:model.defer="company" required size=3>

                                            @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach

                                        </select>
                                        <p class="text-muted pt-1 text-center">Select one company. </p>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if( $Facility_Admin == true || $Facility_Editor == true)
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-2">

                                    <label for="facility">Facility</label>
                                    <select class="form-control text-center text-success" wire:model.defer="facility" multiple>

                                        @foreach ($facilities as $facility)
                                            @if ( in_array( $facility->id, $facilitiesID)
                                             ||   auth()->user()->hasRole('Platform Admin')
                                             || ( auth()->user()->hasRole('Regional Admin') && auth()->user()->can($facility->Permissions->name) ) )
                                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="text-muted pt-1 text-center">Press CTRL to select multiple values. </p>
                                    
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-2 mt-2">
                                    <button type="submit" class="btn btn-success form-control">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


