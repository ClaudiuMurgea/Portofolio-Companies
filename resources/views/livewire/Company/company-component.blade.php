<div>
    <div class="position-absolute start-0 w-100">

        <div class="d-flex justify-content-between">
            <h6 class="card-title mb-5 pl-2">Companies</h6>
            
            @if( auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )
            <button class="btn btn-success btn-sm mb-5" disabled> Add Company </button>     
            @else  
            <button wire:click="show('showCreate')" class="btn btn-success btn-sm mb-5"> Add Company </button>
            @endif  
        </div> 
    
        @if($showIndex == true)
            <livewire:company.company-index/>
        @endif

        @if($showCreate == true)
            <livewire:company.company-create/>
        @endif

        @if($showEdit == true)
            <livewire:company.company-edit :mosad="$ids"/>
        @endif

    </div>
</div>
