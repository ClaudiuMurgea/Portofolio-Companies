@if($showIndex == true) 
        <livewire:region.region-index/>
@endif


@if($showCreate == true)
        <div>
                <livewire:region.region-create/>      
        </div>
@endif


@if($showEdit == true)
        <div>
                <livewire:region.region-edit :regionID="$ids"/>
        </div>
@endif
