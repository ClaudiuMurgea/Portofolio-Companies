<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Company;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\CompanyAdmin;
use App\Models\CompanyProfile;

class CompanyIndex extends Component
{   
    use WithPagination;
    public $searchTerm;
    
    public $corporateID;
    public $userCompany;
    public $corporateAdmin;
    public $uniqueID;

    public $ids;
    public $showIndex    = true;
    public $showCreate   = false;
    public $showEdit     = false;

    public $showFacilities    = false;
    public $showBanners       = false;
    public $showAnnouncements = false;

    public $createSettings   = false;


    public $trashed;
    public $settings;
    public $address;

    public $nr = 0;

    public function show ( $type, $ids = null )
    {
        $this->showIndex  = false;
        $this->showCreate = false;
        $this->showEdit   = false;

        $this->showFacilities    = false;
        $this->showBanners       = false;
        $this->showAnnouncements = false;  
        $this->createSettings    = false;  
 
        $this->$type      = true;
        $this->ids        = $ids;
    }

    public function settings ()
    {
        $this->nr++;
        if($this->nr % 2 == 0 )
        {
            $this->settings = false;
        } else 
        {
            $this->settings = true;
        }
    }

    public function address ()
    {
        $this->nr++;
        if($this->nr % 2 == 0 )
        {
            $this->address = false;
        } else 
        {
            $this->address = true;
        }
    }

    public function mount ()
    {   
        $this->corporateAdmin = CompanyAdmin::where( 'user_id', auth()->user()->id )->first();

        if( auth()->user()->hasRole('Corporate Admin') )
        {
            $this->corporateID = auth()->user()->companyAdmin->first()->company_id;
            $this->userCompany[] = Company::findOrFail($this->corporateID);
            $this->ids = $this->corporateID;
        }
        if( auth()->user()->hasAnyRole('Facility Admin|Facility Editor') )
        {   
            foreach( auth()->user()->facilityUsers as $facility )
            {
                $this->corporateID[] = $facility->company_id;
            }
                $this->uniqueID = array_unique($this->corporateID);

            foreach($this->uniqueID as $companyID)
            {
                $this->userCompany[] = Company::findOrFail($companyID); 
            }
        }
    }

    public function render ()
    {   
        return view('livewire.company.company-index', ['companies' => Company::withTrashed()->where(function($sub_query)
        {
            $sub_query->where('name', 'like', '%' .$this->searchTerm.'%');
        })->paginate(12)
        ])->layout('layouts.admin.master');
    }     

    public function destroy ($id)
    {   
        $company = Company::findOrFail($id);
        // $company->Profile->Media->delete();

        if ( $company->Facilities == true)
        {
            foreach ($company->facilities as $facility)
            {   
                if ( $facility->FacilityUsers == true )
                {
                    foreach($facility->facilityUsers as $facilityUser)
                    {
                        $user = User::find($facilityUser->user_id);
                        $user->active = 0;
                        $user->save();
                    }
                }
                // $facility->Profile->Media->delete();
                $facility->Profile->delete();
                $facility->delete();
            }
        }
      
        foreach($company->companyAdmins as $admin)
        {
            $userAdmin = User::find($admin->user_id);

            if($userAdmin->roles->first()->name == 'Corporate Admin')
            {   
                $userAdmin->active = 0;
                $userAdmin->save();
            }
        }
        $company->Profile->delete();
        $company->delete();
    }

    public function restore ($id)
    {
        $companyProfile = CompanyProfile::withTrashed()->where('company_id', $id)->restore();
       
        $facilities = Facility::withTrashed()->where('company_id', $id)->get();
        foreach ($facilities as $facility)
        {   
            if ( $facility->FacilityUsers == true )
            {
                foreach($facility->facilityUsers as $facilityUser)
                {
                    $user = User::find($facilityUser->user_id);
                    $user->active = 1;
                    $user->save();
                }
            }
            // $facility->Profile->Media->delete();
            $facility->restore();
            $facilityProfile = FacilityProfile::withTrashed()->where('facility_id', $facility->id)->first();
            $facilityProfile->restore();
        }

        $company = Company::withTrashed()->where('id', $id)->first();
        foreach($company->companyAdmins as $admin)
        {
            $userAdmin = User::find($admin->user_id);

            if($userAdmin->roles->first()->name == 'Corporate Admin')
            {   
                $userAdmin->active = 1;
                $userAdmin->save();
            }
        }

        $company->restore();
    }
}
