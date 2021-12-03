<div>
    @section('title', 'Display Types')

<div class="position-absolute start-0 w-100">

  <nav class="page-breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"> <a href="{{ route('livewire.display') }}">&emsp; Display Types &emsp;</a> </li>
          <li class="breadcrumb-item active" aria-current="page">&emsp; All Display Types </li>
      </ol>
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
                  <td class="text-center col-1"> ID     </td>
                  <td class="text-center col-8"> Name   </td>
                  <td class="text-center col-3"> Action </td>
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
                              <button wire:click="show('showEdit', {{ $displayType->id }})" class="btn btn-link p-0 mx-4"><i data-feather="edit-3"></i>Edit</button>
                                      
                              <button wire:click="destroy({{ $displayType->id }})" class="btn btn-link p-0 mx-4 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>
                            @else
                              <button class="btn btn-link p-0 mx-5" disabled><i data-feather="edit-3"></i>Edit</button>
                              <button class="btn btn-link p-0 mx-5 text-danger" disabled><i data-feather="delete"></i>Delete</button>
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
</div>
