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
    public $facilityID;
    public $facilityIDS = [];

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
        $this->company = Company::find($company);
        $this->ids = $company;

        if(auth()->user()->facilityUsers()->exists())
        {
            foreach(auth()->user()->facilityUsers as $facilityUser)
            {
                $this->facilityIDS[] = $facilityUser->facility_id;
            }
        }
    }

    public function render()
    {   
        return view('livewire.facility.facility-index', ['facilities' => Facility::withTrashed()->where('company_id', $this->ids)->where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%');
        })->paginate(12)
        ])->layout('layouts.admin.master');
    }

    public function destroy ($id)
    { 
        $facility = Facility::findOrFail($id);
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

    public function restore ($id)
    {
        $facility = Facility::withTrashed()->where('id', $id)->restore();
        $facilityProfile = FacilityProfile::withTrashed()->where('facility_id', $id)->restore();
        
        $facility = Facility::findOrFail($id);

        if( $facility->facilityUsers != null )
        {
            foreach($facility->facilityUsers as $facilityUser)
            {   
                $user = User::findOrFail($facilityUser->user_id);
                    $user->active = 1;
                    $user->save();
            }
        }
    }
}
