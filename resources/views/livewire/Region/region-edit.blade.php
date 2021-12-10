<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.region') }}">&emsp; Regions &emsp;</a> </li>
            <li class="breadcrumb-item active" aria-current="page">&emsp; Edit Region </li>
        </ol>
    </nav>

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

                    <div class="row mb-3">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-3">
                                <button wire:click="update({{ $ids }})" class="form-control mt-4 btn btn-success">Edit Display Type</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="position-absolute bottom-40 end-50">
                        <i wire:loading wire:target="update({{ $ids }})" class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
