<div>

    @if ($active == true)
        <div class="position-absolute start-0 w-100">
            
            <nav class="navbar navbar-light p-0">
                <div class="container-fluid">
                <a class="navbar-brand text-success p-0">{{ ucfirst($company->name) }}&nbsp; / &nbsp; Settings </a>

                <a wire:click="back" class="navbar-brand btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
                </div>
            </nav>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-1">Company Settings</h6>
                            <p class="mb-5">&emsp;&emsp;&emsp;0 MEANS ∞</p>
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-2">

                                        <label for="facilities">Set facilities limit</label>
                                    
                                        <input wire:model.defer="facilities" class="form-control" type="number"  min="0" step="1" required>
                                        
                                        @error('facilities')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-2">

                                        <label for="monitors">Set monitors limit</label>
                                        <input wire:model.defer="monitors" class="form-control" type="number"  min="0" step="1" required>
                                        
                                        @error('monitors')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <label for="displayTypes">Display types</label>
                            </div>

                            {{-- {!! in_array($display_type->id,$allowedDisplay) ? 'checked' : '' !!} value="{!! $display_type->id !!}" --}}

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    @foreach($display_types as $display_type)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input wire:model.defer="displayTypes" type="checkbox" class="form-check-input" value="{{ $display_type->id }}">
                                                {!! $display_type->name !!}
                                                <i class="input-frame"></i>
                                                {{-- <select name="" id="" multiple>
                                                    <option value="{{  }}">{{ $display_type->name }}</option>
                                                </select> --}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="form-group col-md-2 mt-2">
                                        <button wire:click="save" class="btn btn-success form-control mb-3">Save Settings</button>
                                    </div>
                                </div>
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
