<div>
    <div class="position-absolute start-0 w-100">
    
        @if($active == true)
            <nav class="navbar navbar-light p-0">
                <div class="container-fluid">
                    <a class="navbar-brand text-success p-0">Display Types &nbsp; / &nbsp; Create Display Type</a>
                    <a wire:click="back" class="navbar-brand btn btn-success text-white p-0 col-md-1 d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                        Back &nbsp; 
                    </a>
                </div>
            </nav>
        
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            
                            <h6 class="card-title text-center">Display Details</h6>
        
                            <div class="row">
                                <div class="d-flex justify-content-around">

                                    <div class="form-group col-md-4 mt-5">
                                        <input class="form-control" wire:model.defer="name" placeholder="Name...">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
        
                            <div class="row mb-3">                       
                                <div class="d-flex justify-content-center">
                                    <div class="col-2">
                                        <button wire:click="create" class="form-control mt-2 btn btn-success" type="submit">Create Display Type</button>
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
        @endif 

        @if($return == true)
            <div>
                <livewire:display.display-index/>        
            </div>
        @endif
    </div>
</div>
