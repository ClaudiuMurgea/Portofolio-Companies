@if($showIndex == true)
    <livewire:facility.facility-index :companyID="$companyID">
@endif

@if($showCreate == true)
    <div>
        <livewire:facility.facility-create :companyID="$companyID">
    </div>
@endif

@if($showEdit == true)
    <div>
        <livewire:facility.facility-edit :facilityID="$ids">
    </div>
@endif