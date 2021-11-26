<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.facility', $company->id) }}">&emsp; Facilities</a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Create Facility </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-center">Facility Details</h6>


                    <form  wire:submit.prevent="create" enctype="multipart/form-data">
                        @csrf 
                    
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" wire:model="name">
                                    
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="address">Address</label>
                                        <input class="form-control" type="text" wire:model="address">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="city">City</label>
                                        <input class="form-control" type="text" wire:model="city">

                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="zip">Zip Code</label>
                                    <input class="form-control" type="text" wire:model="zip">

                                    @error('zip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="state">State</label>
                                    <select wire:model="state" class="form-control" id="state">
                                        
                                        <option value="">Select state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                        @endforeach

                                    </select>
                                    @error('state')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                

                                <div class="form-group col-md-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="text" wire:model="phone">

                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="region">Region</label>
                                    <select class="form-control" wire:model="region">
                                        
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

                                <div class="form-group col-md-3">
                                    <label for="logo">Logo</label>
                                    
                                    <input class="form-control" type="file" wire:model="logo">

                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">
                                <div class="col-3">
                                    <button class="form-control mt-4 btn btn-success" type="submit">Create Facility</button>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="color">Color</label>
                                    <input class="form-control" type="text" wire:model="color">
                                    @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">                       
                            <div class="d-flex justify-content-center">
                                @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class="imgs" alt="image">
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>