<div>
    <div class="container">

        @if($selectData == true)
            @include('livewire.Display.index')
        @endif

        @if($createData == true)
            @include('livewire.Display.create')
        @endif

        @if($updateData == true)
            @include('livewire.Display.edit')
        @endif

    </div>
 </div>
