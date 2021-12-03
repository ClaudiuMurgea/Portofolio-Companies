@if($showIndex == true)
    <livewire:user.user-index/>
@endif

@if($showCreate == true)
    <div>
        <livewire:user.user-create/>
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:user.user-edit :userID="$ids"/>
    </div>
@endif