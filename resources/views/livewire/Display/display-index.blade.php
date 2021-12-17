@if($showIndex == true) 
  <div class="position-absolute start-0 w-100">

    <nav class="navbar navbar-light p-0">
      <div class="container-fluid">
          <a class="navbar-brand text-success  p-0">Display Types &nbsp; / &nbsp; All Display Types</a>
      </div>
  </nav>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <div class="d-flex justify-content-between">
              
              <h6 class="card-title mb-5">Display Types</h6>

              @if (auth()->user()->hasRole('Platform Admin'))
                <button wire:click="show('showCreate')" class="btn btn-success btn-sm mb-5">Add Type</button>
              @else 
                <button class="btn btn-success btn-sm mb-5" disabled>Add Type</button>
              @endif
              
            </div>

            <div class="table table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-success">
                    <th class="text-center col-1"> ID     </th>
                    <th class="text-center col-8"> Name   </th>
                    <th class="text-center col-3"> Action </th>
                  </tr>
                </thead>        
          
                <tbody>
                  @foreach ( $displayTypes as $displayType)

                    <tr class="table-success">        
                      <td class="text-center col-1"> {{ $displayType->id }}   </td>
                      <td class="text-center col-8"> {{ $displayType->name }} </td>

                      <td class="no-gutters p-0 col-3">
                        <table class="table table-borderless no-gutters">
                            <div class="d-flex justify-content-between">                 
                              @if (auth()->user()->hasRole('Platform Admin'))
                                <button wire:click="show('showEdit', {{ $displayType->id }})" class="btn btn-link p-0 mx-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                  Edit
                                </button>
                                <button wire:click="destroy({{ $displayType->id }})" class="btn btn-link p-0 mx-4 text-danger" onclick="return confirm('Are you sure?')">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                  Delete
                                </button>
                              @else
                                <button class="btn btn-link p-0 mx-5" disabled>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                  Edit
                                </button>
                                <button class="btn btn-link p-0 mx-5 text-danger" disabled>
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
        <livewire:display.display-create/>      
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:display.display-edit :displayTypeID="$ids"/>
    </div>
@endif


