<div class="position-absolute start-0 w-100">

    <div class="d-flex">
        <span> <a href="{{ route('livewire.company') }}">&emsp; Companies</a>                     </span>
        <span> &emsp; / &emsp; Create Company                                                     </span>
        <span class="offset-9 ml-5">&emsp;&emsp; <a class="btn btn-sm btn-primary" href="/companies">Go back</a> </span>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <h6 class="card-title text-center">Company Details</h6>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input wire:model.defer="name" class="form-control" type="text"  placeholder="Name...">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input wire:model.defer="address" class="form-control" type="text" placeholder="Address...">

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
                                <input wire:model.defer="city" class="form-control" type="text" placeholder="City...">

                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="zip">Zip Code</label>
                                <input wire:model.defer="zip" class="form-control" type="text" placeholder="Zip...">

                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">

                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <select wire:model.defer="state" class="form-control" id="state">
                                    
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                    @endforeach

                                </select>

                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone">Phone</label>
                                <input wire:model.defer="phone" class="form-control" type="text" name="phone" placeholder="Phone...">

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-around">
                            
                            <div class="form-group col-md-4">
                                <label for="name">Color</label>
                                <input wire:model.defer="color" id="colorPicker" class="form-control" type="text" placeholder="Color...">

                                @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="logo">Logo</label>
                                
                                <input wire:model="logo" class="form-control" type="file" value="{{ old('logo') }}">

                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    
                    <div class="position-absolute bottom-60 end-50">
                        <i wire:loading wire:target='create' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                        <i wire:loading wire:target='logo' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i> 
                    </div>

                    <div class="row mb-5 mt-5">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-4">
                                <button wire:click="create" class="form-control mt-4 btn btn-success">Create Company</button>
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

                </div>
            </div>
        </div>
    </div>
</div>