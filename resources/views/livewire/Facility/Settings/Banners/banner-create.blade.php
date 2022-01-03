<div>
    @if ($active == true)

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <nav class="navbar navbar-light p-0">
                            <div class="container-fluid">
                                <a class="navbar-brand text-success  p-0">Add Banner</a>
                                <a wire:click="back" class="navbar-brand btn btn-success text-white  p-0 col-md-1 d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                                    &nbsp;Back &nbsp;
                                </a>
                            </div>
                        </nav>
    
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-3 mt-3">
                                    <input wire:model.defer="title" class="form-control" placeholder="Title ...">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-3 mt-3">
                                    <input type="file" wire:model.defer="banner" class="form-control">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="mx-5">
                                    <label> Starting</label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div wire:ignore class="mx-2 form-group col-md-3 mt-4">
                                    <form wire:submit.prevent="create({{ $facilityID }})">
                                        <input wire:model.lazy="start_at" class="form-control" type="text" id="start_at" placeholder="Start date ...">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <select wire:model.defer="hour" class="col-md-1 text-center">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <select wire:model.defer="minute" class="col-md-1 text-center">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                <select wire:model.defer="meridiem" class="col-md-1 text-center">
                                    <option value="am">am</option>
                                    <option value="pm">pm</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="mt-3 form-group col-md-3">
                                    <select wire:model="options" class="form-control text-center text-success" name="" id="">
                                        <option value="0">Never expire</option>
                                        <option value="1">End at</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        {{-- @if($expireDate == true) --}}

                            {{-- <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="mx-5">
                                        <label> Ending</label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div wire:ignore class="mx-2 form-group col-md-3 mt-5">
                                        <form wire:submit.prevent="create({{ $facilityID }})">
                                            <input wire:model.lazy="end_at" class="form-control" type="text" id="end_at" placeholder="End date ... ( optional )">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <select wire:model.defer="end_hour" class="col-md-1 text-center">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select wire:model.defer="end_minute" class="col-md-1 text-center">
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </select>
                                    <select wire:model.defer="end_meridiem" class="col-md-1 text-center">
                                        <option value="am">am</option>
                                        <option value="pm">pm</option>
                                    </select>
                                </div>
                            </div>
                            {{-- @endif --}}

                        <div class="d-flex justify-content-center">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            @error('start_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            @error('end_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            @error('banner')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        
                   
    
                        <div class="row mb-3 mt-2">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-2">
                                    <button wire:click="create({{ $facilityID }})" class="form-control mt-2 btn btn-success" type="submit">Create Banner</button>
                                </div>
                            </div>
                        </div>

                        <div class="position-absolute bottom-40 end-50">
                            <i wire:loading wire:target='create' class="fa fa-spinner fa-spin mr-2 offset-5 text-success" style="font-size:24px"></i>
                        </div>

                        <div class="row">                       
                            <div class="d-flex justify-content-center">
                                @if ($banner)
                                    <img style="" src="{{ $banner->temporaryUrl() }}" class="imgs" alt="image">
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
            <livewire:facility.settings.banners.banners-index :facility="$facilityID" />      
        </div>
    @endif
</div>

<script src="../pikaday.js"></script>
<script>
    //Calendar input 1
new Pikaday({ field: document.getElementById('start_at') })

    picker = new Pikaday({
    field: document.getElementById('start_at'),
    firstDay: 0,
    setDefaultDate: true,
    minDate: new Date(2021, 11, 14),
    maxDate: new Date(2030, 12, 14),
    yearRange: [2021,2030],

    disableDayFn: function(theDate) {
       return false;
    }
});
</script>

<script>
   //Calendar input 2
   new Pikaday({ field: document.getElementById('end_at') })
    
    picker = new Pikaday({
    field: document.getElementById('end_at'),
    firstDay: 0,
    setDefaultDate: true,
    minDate: new Date(2021, 11, 14),
    maxDate: new Date(2030, 12, 14),
    yearRange: [2021,2030],

    disableDayFn: function(theDate) {
       return false;
    }
});
</script> 
