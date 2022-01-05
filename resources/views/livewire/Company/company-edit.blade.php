@if ($active == true)
    <div class="position-absolute start-0 w-100">
        
        <nav class="navbar navbar-light  p-0">
            <div class="container-fluid">
                <a class="p-0 mb-3">
                    <span class="text-success">Companies</span> 
                        &nbsp; / &nbsp; 
                    <span class="text-dark">Edit Company</span>
                </a>
                <a wire:click="back" class="btn btn-success text-white  p-0 mb-3 col-md-1 d-flex justify-content-center">
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
                                    <label for="edit_name">Name</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_name">
                                    
                                    @error('name')
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

                                    @error('city')
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
                                    <select class="form-control" wire:model.defer="edit_state" id="edit_state">
                                        
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" {{ $company->Profile->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>   
                                        @endforeach

                                    </select>

                                    @error('edit_state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="form-group col-md-4">
                                    <label for="edit_logo">Logo</label>
                                    
                                    <input class="form-control" type="file" wire:model.defer="edit_logo">

                                    @error('edit_logo')
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
                                    <label class="mb-2" for="edit_color">Choose Color</label>
                                        
                                    <input wire:model="edit_color" class="form-control" type="color">

                                    @error('edit_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="position-absolute bottom-60 end-50">
                            <i wire:loading wire:target='edit_logo' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i> 
                            <i wire:loading wire:target='update({{ $ids }})' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i> 
                        </div>

                        <div class="row mt-5">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-4">

                                    <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success">Edit Company</button>
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
            <livewire:company.company-index/>        
        </div>
    @endif

</div>