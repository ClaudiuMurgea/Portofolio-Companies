<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Company;

class FacilityIndex extends Component
{
    protected $listeners = ['show'];

    public Company $company;
    public $facilityID;

    public $searchTerm;
    public $showDetails;
    public $facilityDetails;

    public $ids;
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;

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
        $this->ids = $company->id;
    }

    public function details ($ids)
    {
        $this->showDetails = true;
        $this->facilityDetails = Facility::find($ids);
    }

    public function render()
    {   
        return view('livewire.facility.facility-index', ['facilities' => Facility::where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%');
        })->paginate(12)
        ])->layout('layouts.admin.master');
    }

    public function destroy ($id)
    {
        $facilityProfile = FacilityProfile::findOrFail($id);
            $facilityProfile->Media->delete();
            $facilityProfile->delete();
        
        $facilities = Facility::where('company_id', $id)->get();
            foreach ($facilities as $facility)
            {   
                if ($facility->Profile->Media)
                {
                    $facility->Profile->Media->delete();
                }
                 
                if ($facility->Profile)
                {
                    $facility->Profile->delete();
                }

                $facility->delete();
            }

        $company = Company::findOrFail($id);
            $company->delete();
            
        return redirect('/');
    }
}
