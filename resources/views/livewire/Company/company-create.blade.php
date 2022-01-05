<div class="position-absolute start-0 w-100">

    @if ($active == true)
        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="p-0">
                    <span class="text-success">Companies</span>  
                        &nbsp; / &nbsp; 
                    <span class="text-dark">Create Company</span>
                </a>
                <a wire:click="back" class=" btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <h6 class="card-title text-center mb-5">Company Details</h6>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input wire:model.defer="name" class="form-control" type="text"  placeholder="Name..." id="name">

                                    @error('name')
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
                                    <label for="city">City</label>
                                    <input wire:model.defer="city" class="form-control" type="text" placeholder="City...">

                                    @error('city')
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
                                    <label for="logo">Logo</label>
                                    
                                    <input wire:model="logo" class="form-control" type="file" value="{{ old('logo') }}">

                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">
                                
                                <div class="form-group col-md-4">
                                    <label for="address">Address</label>
                                    <input wire:model.defer="address" class="form-control" type="text" placeholder="Address...">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="mb-2" for="name">Choose Color</label>
                                    <input wire:model="color" class="form-control" type="color">

                                    @error('color')
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
    @endif

    @if($return == true)
        <div>
            <livewire:company.company-index/>        
        </div>
    @endif
</div>
