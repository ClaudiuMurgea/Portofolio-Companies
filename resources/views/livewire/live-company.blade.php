<div>
    <div class="container">

        @if($selectData == true)
            @include('livewire.Company.index')
        @endif

        @if($createData == true)
            @include('livewire.Company.create')
        @endif

        @if($updateData == true)
            @include('livewire.Company.edit')
        @endif

    </div>
 </div>