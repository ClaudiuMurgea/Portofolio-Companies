@if($showIndex == true) 
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
                                        <td class="text-center col-4">  Name        </td>
                                        <td class="text-center col-4">  Description </td>
                                        <td class="text-center col-3">  Action      </td>
                                    </tr>
                                </thead>        
                        
                                <tbody>
                                    @foreach ( $regions as $region)
                                        <tr class="table-success">        
                                            <td class="text-center col-1">  {{ $region->id }}                   </td>
                                            <td class="text-center col-4">  {{ $region->name }}                 </td>
                                            <td class="text-center col-4">  {{ $region->details->description }} </td>

                                            <td class="no-gutters p-0 col-3">
                                                <table class="table table-borderless no-gutters">
                                                    <div class="d-flex justify-content-between">                                                 
                                                    
                                                        @if (auth()->user()->hasRole('Platform Admin'))
                                                            <button wire:click="show('showEdit', {{ $region->id }})" class="btn btn-link p-0 mx-4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit
                                                            </button>

                                                            <button wire:click="destroy({{ $region->id }})" class="btn btn-link p-0 mx-4 text-danger" onclick="return confirm('Are you sure?')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete
                                                            </button>
                                                        @else
                                                            <button class="btn btn-link p-0 mx-4" disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                Edit</button>                                           
                                                            <button class="btn btn-link p-0 mx-4 text-danger" disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                Delete
                                                            </button>  
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

