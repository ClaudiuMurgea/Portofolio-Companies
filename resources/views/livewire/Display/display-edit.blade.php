<div>
    <div class="position-absolute start-0 w-100">

        <div class="d-flex">
            <span> <a href="{{ route('livewire.display') }}">&emsp; Display Types &nbsp;</a>               </span>
            <span> &emsp; / &emsp; Edit Display Type                                                       </span>
            <span class="offset-9 ml-5">&emsp; <a class="btn btn-sm btn-primary" href="/displays">Back</a> </span>
        </div>
    
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title text-center">Display Details</h6>
    
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4 mt-5">
                                    <input class="form-control" type="text" wire:model.defer="edit_name">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
    
                        <div class="row">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-2">
                                    <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success">Edit Display Type</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
