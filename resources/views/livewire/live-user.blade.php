<div>
    <div class="container">
        
        @if($selectData == true)
           @include('livewire.User.index')
        @endif

        @if($createData == true)
            @include('livewire.User.create')
        @endif

        @if($updateData == true)
            @include('livewire.User.edit')
        @endif 
 
    </div>
 </div>
