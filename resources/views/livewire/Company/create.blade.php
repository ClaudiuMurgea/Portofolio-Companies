<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.company') }}">&emsp; Companies</a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Add Company </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-center">Company Details</h6>

                    <form wire:submit.prevent="create">
                        @csrf 
                    
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="name">Name</label>
                                    <input wire:model.defer="name" class="form-control" type="text" placeholder="Name...">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="address">Address</label>
                                    <input wire:model.defer="address" class="form-control" type="text" placeholder="Address...">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-3">
                                    <label for="city">City</label>
                                    <input wire:model.defer="city" class="form-control" type="text" placeholder="City...">

                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
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

                                <div class="form-group col-md-3">
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

                                <div class="form-group col-md-3">
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
                                
                                <div class="form-group col-md-3">
                                    <label for="name">Color</label>
                                    <input wire:model.defer="color" id="colorPicker" class="form-control" type="text" placeholder="Color...">

                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="logo">Logo</label>
                                    
                                    <input wire:model.defer="logo" class="form-control" type="file" value="{{ old('logo') }}">

                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row mb-5">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-3">
                                    <button class="form-control mt-4 btn btn-success" type="submit">Create Company</button>
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

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $('#colorPicker').colorpicker
</script>

@endpush

@push('plugin-scripts')

    {!! Html::script('/assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') !!}

@endpush