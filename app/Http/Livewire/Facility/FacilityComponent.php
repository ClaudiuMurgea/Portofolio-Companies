<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\Company;
use App\Models\Facility;

class FacilityComponent extends Component
{
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;
    public $ids;
    
    public $companyID;
    public $facilityID;
    public Company $company;

    protected $listeners = ['show'];

    public function show ($type, $ids)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;

        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function mount ($company)
    {   
        $this->company = $company;
        $this->companyID = $company->id;
        $this->facilities = Facility::where('company_id', $company->id)->get();
    }

    public function render()
    {
        return view('livewire.facility.facility-component')->layout('layouts.admin.master');
    }
}
