<div class="position-absolute start-0 w-100">

    <div class="d-flex">
        <span> <a href="{{ route('livewire.region') }}">&emsp; Facilities</a>                 </span>
        <span> &emsp; / &emsp; Edit Facility                                                </span>
        <span class="offset-9 ml-5">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
           <a class="btn btn-sm btn-primary" href="/users">Back</a>                           </span>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title text-center">Facility Details</h6>
                    
                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="edit_name">Name</label>
                                <input class="form-control" type="text" wire:model.defer="edit_name">

                                @error('edit_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="edit_logo">Logo</label>
                                
                                <input class="form-control" type="file" wire:model="edit_logo">

                                @error('edit_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="edit_city">City</label>
                                <input class="form-control" type="text" wire:model.defer="edit_city">

                                @error('edit_city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="edit_color">Color</label>
                                <input class="form-control" wire:model.defer="edit_color">
                                
                                @error('edit_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
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

                            <div class="form-group col-md-3">
                                <label for="edit_region">Region</label>
                                <select class="form-control" wire:model.defer="edit_region">
                                    
                                    @foreach ($regions as $region)
                                        @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin'))
                                            <option value="{{ $region->id }}" {{ $facility->Profile->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>  
                                        @endif 
                                    @endforeach

                                </select>

                                @error('edit_region')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
 
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-3">
                                <label for="edit_zip">Zip Code</label>
                                <input class="form-control" type="text" wire:model.defer="edit_zip">
                                
                                @error('edit_zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
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
                            
                            <div class="form-group col-md-3">
                                <label for="edit_address">Address</label>
                                <input class="form-control" type="text" wire:model.defer="edit_address">

                                @error('edit_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-3">
                                <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success">Edit Facility</button>
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
    
</div>
