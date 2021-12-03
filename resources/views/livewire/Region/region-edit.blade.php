<div class="position-absolute start-0 w-100">

    <div class="d-flex">
        <span> <a href="{{ route('livewire.region') }}">&emsp; Regions &nbsp;</a> </span>
        <span> &emsp; / &emsp; Edit Region                                        </span>
        <span class="offset-9 ml-5">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
           <a class="btn btn-sm btn-primary" href="/regions">Back</a>             </span>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <h6 class="card-title text-center">Region Details</h6>

                    <div class="row">
                        <div class="d-flex justify-content-center">

                            <div class="form-group col-md-3 mt-5">
                                <input class="form-control" type="text" wire:model.defer="edit_name">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">

                            <div class="form-group col-md-3 mt-5">
                                <textarea wire:model.defer="edit_description" id="description" cols="6" rows="4" class="form-control" placeholder="Description..."></textarea>
                                
                                @error('edit_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-3">
                                <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success">Edit Display Type</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
