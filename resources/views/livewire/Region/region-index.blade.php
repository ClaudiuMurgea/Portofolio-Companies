@section('title', 'Regions')

<div class="position-absolute start-0 w-100">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{ route('livewire.region') }}">&emsp; Regions &emsp;</a> </li>
            <li class="breadcrumb-item active" aria-current="page">&emsp; All Regions </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <h6 class="card-title mb-5">Regions</h6>

                        @if (auth()->user()->hasRole('Platform Admin'))
                            <button wire:click= "show('showCreate')" class="btn btn-success btn-sm mb-5" > Add Region</button>
                        @else  
                            <button class="btn btn-success btn-sm mb-5" disabled> Add Region</button>
                        @endif   

                    </div>

                    <div class="table table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-success">
                                    <td class="text-center col-1">  ID          </td>
                                    <td class="text-center col-2">  Name        </td>
                                    <td class="text-center col-7">  Description </td>
                                    <td class="text-center col-2">  Action      </td>
                                </tr>
                            </thead>        
                    
                            <tbody>
                                @foreach ( $regions as $region)
                                    <tr class="table-success">        
                                        <td class="text-center col-1">  {{ $region->id }}                   </td>
                                        <td class="text-center col-2">  {{ $region->name }}                 </td>
                                        <td class="text-center col-7">  {{ $region->details->description }} </td>

                                        <td class="no-gutters p-0 col-2">
                                            <table class="table table-borderless no-gutters">
                                                <div class="d-flex justify-content-between">                                                 
                                                
                                                    @if (auth()->user()->hasRole('Platform Admin'))
                                                        <button wire:click="show('showEdit', {{ $region->id }})" class="btn btn-link p-0 mx-4"><i data-feather="edit-3"></i>Edit</button>                                           
                                                        <button wire:click="destroy({{ $region->id }})" class="btn btn-link p-0 mx-4 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>
                                                    @else
                                                        <button class="btn btn-link p-0 mx-4" disabled><i data-feather="edit-3"></i>Edit</button>                                           
                                                        <button class="btn btn-link p-0 mx-4 text-danger" disabled><i data-feather="delete"></i>Delete</button>  
                                                    @endif

                                                </div>
                                            </table>       
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
     
<script>
    feather.replace()
</script>
