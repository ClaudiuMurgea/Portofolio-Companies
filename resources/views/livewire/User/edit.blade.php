<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.user') }}">&emsp; Users </a> </li>
            <li class="breadcrumb-item active" aria-current="page">Edit User Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4 text-center">User Details</h6>

                    <form wire:submit.prevent="update({{ $ids }})">
                        @csrf

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-6 mt-2">

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
                                <div class="form-group col-md-6 mt-2">

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

                                    <label for="region">Region</label>
                                    <select class="form-control" wire:model.defer="region">
                                        <option value="">Select Region</option>

                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
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
                                        
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

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


