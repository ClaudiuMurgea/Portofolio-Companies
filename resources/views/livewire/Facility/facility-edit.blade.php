<div class="position-absolute start-0 w-100">

    @if($active == true)
        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="text-success p-0">
                    <span class="text-success">Facilities</span> 
                        &nbsp; / &nbsp; 
                    <span class="text-dark">Edit Facility</span>
                </a>
                <a wire:click="back" class="btn btn-success text-white col-md-1 p-0 d-flex justify-content-center" href="{{ route('livewire.facility', $companyID) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title text-center mb-5">Facility Details</h6>
                        
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_name">Name</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_name">

                                    @error('edit_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="edit_zip">Zip Code</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_zip">
                                    
                                    @error('edit_zip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_city">City</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_city">

                                    @error('edit_city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="edit_phone">Phone</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_phone">

                                    @error('edit_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_state">State</label>
                                    <select class="form-control" wire:model.defer="edit_state">
                                        
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" {{ $facility->Profile->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>   
                                        @endforeach

                                    </select>
                                    @error('edit_state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="edit_region">Region</label>
                                    <div class="input-group">
                                        <select class="form-control" wire:model.defer="edit_region">
                                            
                                            @foreach ($regions as $region)
                                                @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin'))
                                                    <option value="{{ $region->id }}" {{ $facility->Profile->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>  
                                                @endif 
                                            @endforeach

                                        </select>
                                        <div class="input-group-append" >
                                            <div class="input-group-text bg-success" data-toggle="tooltip" data-placement="top" title="Add New Region"><a href="{{ route('livewire.region') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity text-white m-0"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                    </div>

                                    @error('edit_region')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                
                                </div>
    
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="edit_address">Address</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_address">

                                    @error('edit_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="mb-2" for="edit_color">Color</label>
    
                                    <input wire:model="edit_color" class="form-control" type="color">
                                    
                                    @error('edit_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4">
                                    <label for="edit_logo">Logo</label>
                                    
                                    <input class="form-control" type="file" wire:model="edit_logo">

                                    @error('edit_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                
                                <div class="position-absolute bottom-50 end-50">
                                    <i wire:loading wire:target='update({{ $ids }})' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                                    <i wire:loading wire:target='edit_logo' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                                </div>

                                <div class="col-3 mt-5 col-md-4">
                                    <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success mb-2 mt-5">Edit Facility</button>
                                </div>

                            </div>
                        </div>

                        @if ($edit_logo)
                            <div class="row mt-5">                       
                                <div class="d-flex justify-content-center">                     
                                    <img src="{{ $edit_logo->temporaryUrl() }}" class="imgs" alt="image">                        
                                </div>
                            </div>
                        @elseif($old_logo)
                            <div class="row mt-5">                       
                                <div class="d-flex justify-content-center">
                                    <img src={{ asset('storage/'. $old_logo)}} class="imgs" alt="image">
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($return == true)
        <div>
            <livewire:facility.facility-index :company="$ids" />        
        </div>
    @endif

</div>
