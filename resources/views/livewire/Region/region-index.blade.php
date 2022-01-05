@if($showIndex == true) 
    @section('title', 'Regions')

    <div class="position-absolute start-0 w-100">

        <nav class="navbar navbar-light p-0">
            <div class="container-fluid">
                <a class="p-0">
                    <span class="text-success">Regions</span>
                        &nbsp; / &nbsp; 
                    <span class="text-dark">All Regions</span>
                </a>
            </div>
        </nav>
        
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <h6 class="card-title mb-5">Regions</h6>

                            @if (auth()->user()->hasRole('Platform Admin'))
                                {{-- <button wire:click= "show('showCreate')" class="btn btn-success btn-sm mb-5" > Add Region</button> --}}
                                <a wire:click="show('showCreate')" class="btn btn-success mb-5 p-0 d-flex justify-content-center">&emsp;&emsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    &nbsp;Add Region&emsp;&emsp;&nbsp;
                                </a>
                            @else  
                                <button class="btn btn-success btn-sm mb-5" disabled> Add Region</button>
                            @endif   

                        </div>

                        <div class="table-responsive pt-3 pb-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"> ID                 </th>
                                        <th>                     Name               </th>
                                        <th>                     Description        </th>
                                        <th> &emsp;&emsp;&emsp;&emsp;&nbsp; Action  </th>
                                    </tr>
                                </thead>        
                        
                                <tbody>
                                    @if($regions->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center text-success">
                                                There are no regions defined!
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ( $regions as $region)
                                            <tr>        
                                                <td class="text-center">  {{ $region->id }}                   </td>
                                                <td>                      {{ $region->name }}                 </td>
                                                <td>                      {{ $region->details->description }} </td>

                                                <td class="no-gutters p-0">
                                                    <table class="table table-borderless no-gutters">
                                                        <div class="d-flex justify-content-between">                                                 
                                                        
                                                            @if (auth()->user()->hasRole('Platform Admin'))
                                                                <button wire:click="show('showEdit', {{ $region->id }})" class="btn btn-link mx-5">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit
                                                                </button>

                                                                <button wire:click="destroy({{ $region->id }})" class="btn btn-link mx-5 text-danger" onclick="return confirm('Are you sure?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    Delete
                                                                </button>
                                                            @else
                                                                <button class="btn btn-link mx-5" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                                                    Edit</button>                                           
                                                                <button class="btn btn-link mx-4 text-danger" disabled>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    Delete
                                                                </button>  
                                                            @endif

                                                        </div>
                                                    </table>       
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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

