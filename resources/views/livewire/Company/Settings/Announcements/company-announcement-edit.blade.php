<div>
    @if ($active == true)

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="text-success p-0 mb-3">{{ ucfirst($company->name) }} &nbsp; / &nbsp;&nbsp;Edit Announcement &nbsp; </a>
                <a wire:click="back" class="navbar-brand btn btn-success text-white p-0 mb-3 col-md-1 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
                    &nbsp;Back &nbsp;
                </a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
    
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-3">
                                    <input wire:model.defer="edit_title" class="form-control" placeholder="Title ...">

                                    @error('edit_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="form-group col-md-4 mt-3">
                                    <input wire:model.defer="edit_text" class="form-control" placeholder="Text ...">

                                    @error('edit_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="mx-5">
                                    <label> Valid from &emsp;&emsp;&nbsp;</label>
                                </div>

                                <div class="mx-5">
                                    <label> Valid until </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                {{-- <div wire:ignore>
                                    <input wire:model="datepicker1" class="mx-4" type="date" id="datepicker1">
                                </div>
                                
                                <div wire:ignore>
                                    <input wire:model="datepicker2" class="mx-4" type="date"  id="datepicker2">
                                </div> --}}

                                <div wire:ignore class="mx-5">
                                    <form wire:submit.prevent="edit({{ $announcementID }})">
                                        <input wire:model.lazy="start_date" class="form-control" type="text" id="start_date">
                                    </form>
                                </div>

                                <div wire:ignore class="mx-5">
                                    <form wire:submit.prevent="edit({{ $announcementID }})">
                                        <input wire:model.lazy="end_date" class="form-control" type="text" id="end_date">
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="row mb-3 mt-2">                       
                            <div class="d-flex justify-content-center">
                                <div class="col-2">
                                    <button wire:click="edit({{ $announcementID }})" class="form-control mt-2 btn btn-success" type="submit">
                                        Edit Announcement
                                    </button>
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
        
    @endif

    @if($return == true)
        <div>
            <livewire:company.settings.announcements.company-announcements-index :company="$companyID" />      
        </div>
    @endif

    <script>
        new Pikaday({ field: document.getElementById('start_date') });
    </script>

</div>

<script>
    //Calendar input 1

    new Pikaday({ field: document.getElementById('end_date') })

        picker = new Pikaday({
        field: document.getElementById('end_date'),
        firstDay: 0,
        setDefaultDate: true,
        minDate: new Date(2021, 11, 14),
        maxDate: new Date(2030, 12, 14),
        yearRange: [2021,2030],

        disableDayFn: function(theDate) {
        return false;
        }
    });

   //Calendar input 2

    // new Pikaday({ field: document.getElementById('second_date') })
        
    //     picker = new Pikaday({
    //     field: document.getElementById('second_date'),
    //     firstDay: 0,
    //     setDefaultDate: true,
    //     minDate: new Date(2021, 11, 14),
    //     maxDate: new Date(2030, 12, 14),
    //     yearRange: [2021,2030],

    //     disableDayFn: function(theDate) {
    //     return false;
    //     }
    // });
</script>
