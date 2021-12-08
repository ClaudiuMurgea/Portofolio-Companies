@section('title', 'Companies')

@if($showIndex == true)
    <div class="position-absolute start-0 w-100">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ route('livewire.company') }}">&emsp; Companies &emsp;</a> </li>
                <li class="breadcrumb-item active" aria-current="page">&emsp; All Companies </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <h6 class="card-title mb-5 pl-2">Companies</h6>
                            
                            @if( auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )
                                <button class="btn btn-success btn-sm mb-5" disabled> Add Company </button>     
                            @else  
                                <button wire:click="show('showCreate')" class="btn btn-success btn-sm mb-5"> Add Company </button>
                            @endif 
                            
                        </div> 

                        <div class="table table-responsive pt-3">
                            <table class="table table-bordered">

                                <thead>
                                    <tr class="table-success">
                                        <td class="text-center col-1">  ID       </td>
                                        <td class="text-center col-1">  Name     </td>
                                        <td class="text-center col-1">  Address  </td>
                                        <td class="text-center col-1">  City     </td>
                                        <td class="text-center col-1">  State    </td>
                                        <td class="text-center col-1">  Phone No </td>
                                        <td class="text-center col-1">  Color    </td>
                                        <td class="text-center col-5">  Action   </td>
                                    </tr>
                                </thead>        
                        
                                <tbody>
                                    @if( auth()->user()->hasAnyRole('Platform Admin|Regional Admin') )
                                        @foreach ( $companies as $company)                 
                                            <tr class="table-success">        
                                                <td class="text-center col-1">  {{ $company->id }}                        </td>
                                                <td class="text-center col-1">  {{ $company->name }}                      </td>
                                                <td class="text-center col-1">  {{ $company->Profile->address }}          </td>
                                                <td class="text-center col-1">  {{ $company->Profile->city }}             </td>
                                                <td class="text-center col-1">  {{ $company->Profile->state->short_name }}</td>
                                                <td class="text-center col-1">  {{ $company->Profile->phone }}            </td>
                                                
                                                <td class="col-1">  
                                                    <div class="progress">
                                                    <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $company->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                    </div>
                                                </td>
                                            
                                                <td class="no-gutters p-0 col-5">                 
                                                    <table class="table table-borderless no-gutters">
                                                        <div class="d-flex justify-content-between"> 
                                                                
                                                            <a class="mx-2" href="{{ route('livewire.facility', $company->id) }}"><i id="feather" data-feather="pie-chart"></i>  Facilities </a>

                                                            <a class="mx-2" href="{{ route('livewire.facility', $company->id) }}"> <i data-feather="pocket"></i> Banners </a>

                                                            <a class="mx-2" href="{{ route('livewire.facility', $company->id) }}"> <i data-feather="bell"></i> Announcements </a>

                                                            <button wire:click="show('showEdit', {{ $company->id }})" class="btn btn-link mx-2 p-0"><i data-feather="edit-3"></i>Edit</button>
                                                            <button wire:click="destroy({{ $company->id }})" class="btn btn-link mx-2 p-0 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>

                                                        </div>
                                                    </table>      
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                    @if( auth()->user()->hasAnyRole('Corporate Admin|Facility Admin|Facility Editor') )
                                                    
                                        <tr class="table-success">        
                                            <td class="text-center col-1">  {{ $userCompany->id }}                        </td>
                                            <td class="text-center col-1">  {{ $userCompany->name }}                      </td>
                                            <td class="text-center col-1">  {{ $userCompany->Profile->address }}          </td>
                                            <td class="text-center col-1">  {{ $userCompany->Profile->city }}             </td>
                                            <td class="text-center col-1">  {{ $userCompany->Profile->state->short_name }}</td>
                                            <td class="text-center col-1">  {{ $userCompany->Profile->phone }}            </td>
                                            
                                            <td class="col-1">  
                                                <div class="progress">
                                                <div class="progress-bar " role="progressbar" style="width: 100%;background-color: {!! $userCompany->profile->color !!}" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>    
                                                </div>
                                            </td>
                                        
                                            <td class="no-gutters p-0 col-5">                 
                                                <table class="table table-borderless no-gutters">
                                                    <div class="d-flex justify-content-between"> 
                                                            
                                                        <a class="mx-2" href="{{ route('livewire.facility', $userCompany->id) }}"><i id="feather" data-feather="pie-chart"></i>  Facilities </a>

                                                        <a class="mx-2" href="{{ route('livewire.facility', $userCompany->id) }}"> <i data-feather="pocket"></i> Banners </a>

                                                        <a class="mx-2" href="{{ route('livewire.facility', $userCompany->id) }}"> <i data-feather="bell"></i> Announcements </a>

                                                        <button wire:click="$emit('show', 'showEdit', {{ $userCompany->id }})" class="btn btn-link mx-2 p-0"><i data-feather="edit-3"></i>Edit</button>
                                                        <button wire:click="destroy({{ $userCompany->id }})" class="btn btn-link mx-2 p-0 text-danger" onclick="return confirm('Are you sure?')"><i data-feather="delete"></i>Delete</button>

                                                    </div>
                                                </table>      
                                            </td>
                                            
                                        </tr>

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
        <livewire:company.company-create/>      
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:company.company-edit :companyID="$ids"/>
    </div>
@endif

<script>
    feather.replace()
</script>