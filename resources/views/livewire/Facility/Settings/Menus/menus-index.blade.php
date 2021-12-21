<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h6 class="mb-5">Menus</h6>

                        <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            &nbsp;Add Menu&emsp;
                        </a>
                    </div>

                    <div class="row form-group col-md-2 mx-1">
                        <select wire:model="scheduleType"  class="form-control text-center text-success">
                            <option value="">Select schedule type</option>
                            @foreach ($scheduleTypes as $scheduleType)
                                <option value="{{ $scheduleType->name }}">{{ $scheduleType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div wire:ignore class="form-group col-md-2">
                        <input wire:model.lazy="datepicker" class="form-control" type="text" id="datepicker">
                    </div>

                    {{-- @if ($Weekly == true)
                        <div class="row form-group col-2">
                            <livewire:facility.settings.test/> 
                        </div>
                        <button wire:click="create">Test</button>
                    @endif --}}
                   

                    @if ($Bi_weekly == true)
                        bi-weekly
                    @endif

                    @if ($Tri_weekly == true)
                        tri_weekly
                    @endif

                    @if ($Monthly == true)
                        monthly
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script>
new Pikaday({ field: document.getElementById('datepicker') })

    picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 0,
    // pickWholeWeek: true,
    setDefaultDate: true,
    minDate: new Date(2021, 11, 14),
    maxDate: new Date(2030, 12, 14),
    yearRange: [2021,2030],

    disableDayFn: function(theDate) {
       return false;
    }
});
</script>
