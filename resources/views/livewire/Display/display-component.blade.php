@if($showIndex == true) 
    <livewire:display.display-index/>
@endif

@if($showCreate == true)
    <div>
        <livewire:display.display-create/>      
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:display.display-edit :displayTypeID="$ids"/>
    </div>
@endif

