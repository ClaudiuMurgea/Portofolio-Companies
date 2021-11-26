<div>
    <div class="container">
        
        @if($selectData == true)
           @include('livewire.Facility.index')
        @endif

        @if($createData == true)
            @include('livewire.Facility.create')
        @endif

        @if($updateData == true)
            @include('livewire.Facility.edit')
        @endif 
       
        @if($settingData == true)
            @include('livewire.Facility.show')
        @endif
 
    </div>
 </div>
