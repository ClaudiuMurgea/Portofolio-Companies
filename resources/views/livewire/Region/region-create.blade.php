<div class="position-absolute start-0 w-100">
    
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.region') }}">&emsp; Regions &emsp;</a> </li>
            <li class="breadcrumb-item active" aria-current="page">&emsp; Create Region </li>
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
                                <input class="form-control" type="text" wire:model.defer="name">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">

                            <div class="form-group col-md-3 mt-5">
                                <textarea wire:model.defer="description" id="description" cols="6" rows="4" class="form-control" placeholder="Description..."></textarea>
                               
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">                       
                        <div class="d-flex justify-content-center">
                            <div class="col-3">
                                <button wire:click="create" class="form-control mt-4 btn btn-success">Create Display Type</button>
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute bottom-40 end-50">
                        <i wire:loading wire:target='create' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
