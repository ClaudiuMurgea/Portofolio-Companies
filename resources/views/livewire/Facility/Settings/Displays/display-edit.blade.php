<div>
    <div class="position-absolute start-0 w-100">

        @if ($active == true)
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            
                            <nav class="navbar navbar-light p-0">
                                <div class="container-fluid">
                                    <a class="navbar-brand text-success  p-0">Edit Display</a>
                                    <a wire:click="back" class="navbar-brand btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                                        &nbsp;Back &nbsp;
                                    </a>
                                </div>
                            </nav>
        
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-3">
                                        <input wire:model.defer="edit_name" class="form-control" placeholder="&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Name ...">

                                        @error('edit_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-3">
                                        <select wire:model.defer="edit_type" class="form-control text-center text-success">
                                            <option value="">Select type</option>
                                            @foreach ($displayTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('edit_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-3">
                                        <select wire:model.defer="edit_orientation" class="form-control text-center text-success">
                                            <option value="">Select orientation</option>
                                            <option value="1">Horizontal</option>
                                            <option value="0">Vertical</option>
                                        </select>

                                        @error('edit_orientation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-check mx-4">
                                        <input wire:click="option('showColor')" name="radio" class="form-check-input" type="radio">
                                        <label class="form-check-label">
                                        Color
                                        </label>
                                    </div>

                                    <div class="form-check mx-4">
                                        <input wire:click="option('showImage')" name="radio" class="form-check-input" type="radio">
                                        <label class="form-check-label">
                                        Image
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if ($showColor == true)
                                <div class="row">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-group col-md-2 mt-3">
                                            <input wire:model="edit_color" class="form-control" type="color">

                                            @error('edit_color')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($showImage == true)
                                <div class="row">
                                    <div class="d-flex justify-content-center">
                                        <div class="form-group col-md-2 mt-3">
                                            <input wire:model="image" class="form-control" type="file">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3 mt-2">                       
                                <div class="d-flex justify-content-center">
                                    <div class="col-2">
                                        <button wire:click="edit({{ $displayID }})" class="form-control mt-2 btn btn-success">Edit Display</button>
                                    </div>
                                </div>
                            </div>

                            <div class="position-absolute bottom-40 end-50">
                                <i wire:loading wire:target='edit' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($return == true)
        <div>
            <livewire:facility.settings.displays.displays-index :facility="$facilityID" />      
        </div>
    @endif
</div>

<script>
    var parent = document.querySelector('#parent');
    var picker = new Picker(parent);
</script>