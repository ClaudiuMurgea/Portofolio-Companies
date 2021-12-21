<div class="position-absolute start-0 w-100">

    @if($active == true)
        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="navbar-brand text-success p-0">Facilities &nbsp; / &nbsp; Create Facility</a>
                <a wire:click="back" class="navbar-brand btn btn-success text-white p-0 col-md-1 d-flex justify-content-center" href="{{ route('livewire.facility', $ids) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title text-center mb-5">Facility Details</h6>
                        
                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" wire:model.defer="name">
                                    
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="zip">Zip Code</label>
                                    <input class="form-control" type="text" wire:model.defer="zip">

                                    @error('zip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
            
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                        <input class="form-control" type="text" wire:model.defer="city">

                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="text" wire:model.defer="phone">

                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="state">State</label>
                                    <select class="form-control" id="state" wire:model.defer="state">
                                        
                                        <option value="">Select state</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>   
                                        @endforeach

                                    </select>
                                    @error('state')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="region">Region</label>
                                    <div class="input-group">
                                        <select class="form-control" wire:model.defer="region">
                                            
                                            <option value="">Select region</option>
                                            @foreach ($regions as $region)
                                                @if(auth()->user()->hasPermissionTo($region->name) || auth()->user()->hasRole('Platform Admin|Corporate Admin'))
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                        <div class="input-group-append" >
                                            <div class="input-group-text bg-success" data-toggle="tooltip" data-placement="top" title="Add New Region"><a href="{{ route('livewire.region') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity text-white m-0"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                    </div>
                                    @error('region')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror     
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-around">

                                <div class="form-group col-md-4">
                                    <label for="address">Address</label>
                                        <input class="form-control" type="text" wire:model.defer="address">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="mb-2" for="color">Color</label>

                                    <input wire:model="color" class="form-control" type="color">
                                    
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                        
                                <div class="form-group col-md-4">
                                    <label for="logo">Logo</label>
                                    
                                    <input class="form-control" type="file" wire:model.defer="logo">

                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">

                                <div class="position-absolute bottom-50 end-50">
                                    <i wire:loading wire:target='create' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                                    <i wire:loading wire:target='logo' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                                </div>
                                    
                                <div class="col-3 mt-5 col-md-4">
                                    <button wire:click="create" class="form-control mt-4 btn btn-success">Create Facility</button>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-5">                       
                            <div class="d-flex justify-content-center">
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" class="imgs" alt="image">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($return == true)
        <div>
            <livewire:facility.facility-index :company="$ids" />        
        </div>
    @endif

</div>

<script>
    document.getElementById("myButton3").addEventListener("click", () => {

    
var x = document.getElementById("myButton3").value;

//Check if register button
if (x.includes("Submit")) {

  //assign value to favColor    
  var favColor = document.getElementById("favcolor").value;
    
}

var message3 = `the color you selected is: ${favColor}<br>`;

document.getElementById("par3").innerHTML = message3.fontcolor("&(favColor)");  
});
</script>