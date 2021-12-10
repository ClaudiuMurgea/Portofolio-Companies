<div class="position-absolute start-0 w-100">

    <div class="d-flex">
        <span> <a href="{{ route('livewire.region') }}">&emsp; Facilities</a>                 </span>
        <span> &emsp; / &emsp; Create Facility                                                </span>
        <span class="offset-9 ml-5">&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
           <a class="btn btn-sm btn-primary" href="/users">Go back</a>                           </span>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title text-center">Facility Details</h6>
                    
                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" wire:model.defer="name">
                                
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                    <input class="form-control" type="text" wire:model.defer="address">

                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="city">City</label>
                                    <input class="form-control" type="text" wire:model.defer="city">

                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
  
                            <div class="form-group col-md-4">
                                <label for="color">Color</label>
                                <input class="form-control" type="text" wire:model.defer="color">
                                
                                @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <select class="form-control" id="state" wire:model.defer="state">
                                    
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                    @endforeach

                                </select>
                                @error('state')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="region">Region</label>
                                <select class="form-control" wire:model.defer="region">
                                    
                                    <option value="">Select region</option>
                                    @foreach ($regions as $region)
                                        @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin'))
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endif
                                    @endforeach

                                </select>

                                @error('region')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror     
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="zip">Zip Code</label>
                                <input class="form-control" type="text" wire:model.defer="zip">

                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" wire:model.defer="phone">

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">
                    
                            <div class="form-group col-md-4">
                                <label for="logo">Logo</label>
                                
                                <input class="form-control" type="file" wire:model.defer="logo">

                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    </div>


                    <div class="row">
                        <div class="d-flex justify-content-center">

                            <div class="position-absolute bottom-50 end-50">
                                <i wire:loading wire:target='create' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                                <i wire:loading wire:target='logo' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                            </div>
                                 
                            <div class="col-3 mt-5 col-md-4">
                                <button wire:click="create" class="form-control mt-4 btn btn-success">Create Facility</button>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-5">                       
                        <div class="d-flex justify-content-center">
                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class="imgs" alt="image">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>