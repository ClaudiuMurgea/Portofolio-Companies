<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\Facility;

class FacilityIndex extends Component
{
    public $facilities;
    public $ids;

    public function mount ($companyID)
    {   
        $this->ids = $companyID;
        $this->facilities = Facility::where('company_id', $companyID)->get();
    }

    public function render()
    {   
        return view('livewire.facility.facility-index')->layout('layouts.admin.master');
    }
}
