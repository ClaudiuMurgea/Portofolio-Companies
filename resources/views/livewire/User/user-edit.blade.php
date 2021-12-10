<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb ml-3 pl-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item pl ml-3 pl-3"> <a href="{{ route('livewire.user') }}">&emsp; Users &emsp;</a> </li>
            <li class="breadcrumb-item active" aria-current="page">&emsp; Edit User </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4 text-center">User Details</h6>

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
</div>


