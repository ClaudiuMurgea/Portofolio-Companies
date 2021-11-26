<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('livewire.company') }}">&emsp; Companies</a> </li>
        <li class="breadcrumb-item active" aria-current="page"> Edit Company Details</li>
    </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-center">Company Details</h6>

                    <form wire:submit.prevent="update({{ $ids }})">
                        @csrf 
                    
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="edit_name">Name</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_name">
                                    
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="edit_address">Address</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_address">

                                    @error('edit_address')
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

                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
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

                                <div class="form-group col-md-3">
                                    <label for="edit_state">State</label>
                                    <select class="form-control" wire:model.defer="edit_state" id="edit_state">
                                        
                                        <option value="">Select state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                        @endforeach

                                    </select>

                                    @error('edit_state')
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
                                    <label for="edit_color">Color</label>
                                    <input class="form-control" type="text" wire:model.defer="edit_color">

                                    @error('edit_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="edit_logo">Logo</label>
                                    
                                    <input class="form-control" type="file" wire:model.defer="edit_logo">

                                    @error('edit_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        <div class="row">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-3">
                                    <button class="form-control mt-4 btn btn-success" type="submit">Edit Company</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>