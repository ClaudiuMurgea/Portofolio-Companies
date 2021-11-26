<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.user') }}">&emsp; Users </a> </li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4 text-center">User Details</h6>

                    <form wire:submit.prevent="create">
                        @csrf

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-6 mt-2">

                                    <label for="name">Full Name</label>
                                    <input class="form-control" type="text" wire:model.defer="name" required>
                                    
                                    @error('name')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-6 mt-2">

                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" wire:model.defer="email" required>
                                    
                                    @error('email')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-6 mt-2">

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" wire:model.defer="password" required>
                                    
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
                                <div class="form-group col-md-6 mt-2">

                                    <label for="role">Region</label>
                                    <select class="form-control" wire:model.defer="region">
                                        <option value="">Select Region</option>

                                        @foreach ($regions as $region)
                                            @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin'))
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('region')
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-6 mt-2">

                                    <label for="role">Role</label>
                                    <select class="form-control" wire:model.defer="role" required>

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
                                        <span class="text-danger">
                                            {!! $message !!}
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-3 mt-2">
                                    <button class="btn btn-success form-control" type="submit">Submit </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


