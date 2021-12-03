@if($showIndex == true) 
        <livewire:company.company-index/>
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