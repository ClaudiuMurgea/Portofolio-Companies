<div>
    <div class="container">

        @if($selectData == true)
            @include('livewire.Region.index')
        @endif

        @if($createData == true)
            @include('livewire.Region.create')
        @endif

        @if($updateData == true)
            @include('livewire.Region.edit')
        @endif

    </div>
 </div>
