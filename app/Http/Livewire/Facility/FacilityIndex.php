<?php

namespace App\Http\Livewire\Facility;

use Livewire\Component;
use App\Models\User;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\Company;

class FacilityIndex extends Component
{
    protected $listeners = ['show'];

    public $company;

    public $searchTerm;
    public $facilityDetails;

    public $ids;
    public $showIndex  = true;
    public $showCreate = false;
    public $showEdit   = false;

    public function show ($type, $ids = null)
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;

        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function mount ($company)
    {   
        $this->company = Company::findOrFail($company);
        $this->ids = $company;
    }

    public function render()
    {   
        return view('livewire.facility.facility-index', ['facilities' => Facility::where('company_id', $this->ids)->where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%');
        })->paginate(12)
        ])->layout('layouts.admin.master');
    }

    public function destroy ($id)
    { 
        $facility = Facility::findOrFail($id);
            $facility->Profile->Media->delete();
            $facility->Profile->delete();

            if($facility->facilityUsers == true)
            {
                foreach($facility->facilityUsers as $facilityUser)
                {   
                    $user = User::findOrFail($facilityUser->user_id);
                        $user->active = 0;
                        $user->save();
                }
            }
            
        $facility->delete();
    }
}
